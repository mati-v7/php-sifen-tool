<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Tests\Unit\Infrastructure\Xml\Generator;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\DocumentNumber;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\EstablishmentCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ExpeditionPoint;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ItemVat;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Money;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Percentage;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Ruc;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\SecurityCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\TaxAuthorizationNumber;
use Nyxcode\PhpSifenTool\Domain\DE\Builder\InvoiceBuilder;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\ElectronicDocument;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\InvoiceData;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Issuer;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Item;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Operation;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\PaymentCondition;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Receiver;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\TaxAuthorization;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\ElectronicDocumentType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\EmissionType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\OperationConditionType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\PresenceIndicator;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\VatTreatment;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Generator\InvoiceXmlGenerator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class InvoiceXmlGeneratorTest extends TestCase
{
    #[DataProvider('buildSampleInvoice')]
    public function test_generate_with_valid_invoice_returns_xml_string(ElectronicDocument $invoice): void
    {
        $generator = new InvoiceXmlGenerator;

        $xmlString = $generator->generate($invoice);

        $this->assertIsString($xmlString);
        $this->assertStringContainsString('rDE', $xmlString);
        $this->assertStringContainsString('DE', $xmlString);
        $this->assertStringContainsString('<gEmis>', $xmlString);
        $this->assertStringContainsString('<dRucEm>1234567-9</dRucEm>', $xmlString);
        $this->assertStringContainsString('<dNomEmi>ACME Corp</dNomEmi>', $xmlString);
        $this->assertStringContainsString('<gDatRec>', $xmlString);
        $this->assertStringContainsString('<dNumIDRec>987654321</dNumIDRec>', $xmlString);
        $this->assertStringContainsString('<dNomRec>John Doe</dNomRec>', $xmlString);
        $this->assertStringContainsString('<gCamItem>', $xmlString);
        $this->assertStringContainsString('<dDesProSer>Product 1</dDesProSer>', $xmlString);
        $this->assertStringContainsString('<dCantProSer>2</dCantProSer>', $xmlString);
        $this->assertStringContainsString('<dPUniProSer>10</dPUniProSer>', $xmlString);
        $this->assertStringContainsString('<dTotOpeItem>20</dTotOpeItem>', $xmlString);
        $this->assertStringContainsString('<dDesProSer>Product 2</dDesProSer>', $xmlString);
        $this->assertStringContainsString('<dCantProSer>1</dCantProSer>', $xmlString);
        $this->assertStringContainsString('<dPUniProSer>20</dPUniProSer>', $xmlString);
        $this->assertStringContainsString('<dTotOpeItem>20</dTotOpeItem>', $xmlString);
        $this->assertStringContainsString('<gTotSub>', $xmlString);
        $this->assertStringContainsString('<dTotGralOpe>40</dTotGralOpe>', $xmlString);
    }

    public static function buildSampleInvoice(): array
    {
        $operation = new Operation(EmissionType::NORMAL, SecurityCode::generate());

        $taxAuthorization = new TaxAuthorization(
            ElectronicDocumentType::ELECTRONIC_INVOICE,
            new TaxAuthorizationNumber('12345678'),
            new EstablishmentCode('001'),
            new ExpeditionPoint('001'),
            new DocumentNumber('1234567'),
            new \DateTimeImmutable
        );

        $issuer = new Issuer(
            ruc: new Ruc('1234567-9'),
            name: 'ACME Corp',
        );

        $receiver = new Receiver(
            documentNumber: '987654321',
            name: 'John Doe',
        );

        $paymentCondition = new PaymentCondition(OperationConditionType::CASH);
        $invoiceData = new InvoiceData(PresenceIndicator::IN_PERSON);

        $item1 = new Item(
            description: 'Product 1',
            quantity: 2,
            unitPrice: Money::guaranies('10.0'),
            vat: new ItemVat(
                tratment: VatTreatment::VAT_TAXABLE,
                rate: new Percentage(10),
                taxableProportion: new Percentage(100)
            )
        );

        $item2 = new Item(
            description: 'Product 2',
            quantity: 1,
            unitPrice: Money::guaranies('20.0'),
            vat: new ItemVat(
                tratment: VatTreatment::VAT_TAXABLE,
                rate: new Percentage(10),
                taxableProportion: new Percentage(100)
            )
        );

        $invoice = InvoiceBuilder::make(new \DateTimeImmutable)
            ->operation($operation)
            ->taxAuthorization($taxAuthorization)
            ->issuer($issuer)
            ->receiver($receiver)
            ->invoiceData($invoiceData)
            ->paymentCondition($paymentCondition)
            ->addItem($item1)
            ->addItem($item2)
            ->build();

        return [
            'invoice' => [$invoice],
        ];
    }
}
