<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Tests\Unit\Infrastructure\Xml\Generator;

use Nyxcode\PhpSifenTool\Domain\Common\Collection\EconomicActivityCollection;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Address;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\BranchName;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\BusinessName;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\CityCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\DocumentNumber;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\EmailAddress;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\EstablishmentCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ExpeditionPoint;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ItemVat;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Money;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Percentage;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\PhoneNumber;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Ruc;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\SecurityCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\TaxAuthorizationNumber;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\TradeName;
use Nyxcode\PhpSifenTool\Domain\DE\Builder\InvoiceBuilder;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\EconomicActivity;
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
use Nyxcode\PhpSifenTool\Domain\DE\Enum\TaxpayerType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\TaxRegimeType;
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
        $this->assertStringContainsString('<dRucEm>1234567</dRucEm>', $xmlString);
        $this->assertStringContainsString('<dNomEmi>ACME Corp</dNomEmi>', $xmlString);
        $this->assertStringContainsString('<cActEco>0000</cActEco>', $xmlString);
        $this->assertStringContainsString('<gDatRec>', $xmlString);
        $this->assertStringContainsString('<dNumIDRec>987654321</dNumIDRec>', $xmlString);
        $this->assertStringContainsString('<dNomRec>John Doe</dNomRec>', $xmlString);
        $this->assertStringContainsString('<gCamItem>', $xmlString);
        $this->assertStringContainsString('<dDesProSer>Product 1</dDesProSer>', $xmlString);
        $this->assertStringContainsString('<dCantProSer>2</dCantProSer>', $xmlString);
        $this->assertStringContainsString('<dPUniProSer>110000</dPUniProSer>', $xmlString);
        $this->assertStringContainsString('<dTotOpeItem>220000</dTotOpeItem>', $xmlString);
        $this->assertStringContainsString('<dDesProSer>Product 2</dDesProSer>', $xmlString);
        $this->assertStringContainsString('<dCantProSer>1</dCantProSer>', $xmlString);
        $this->assertStringContainsString('<dPUniProSer>150000</dPUniProSer>', $xmlString);
        $this->assertStringContainsString('<dTotOpeItem>150000</dTotOpeItem>', $xmlString);
        $this->assertStringContainsString('<gTotSub>', $xmlString);
        $this->assertStringContainsString('<dTotGralOpe>480000</dTotGralOpe>', $xmlString);
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
            ruc: new Ruc('1234567', 6),
            taxpayerType: TaxpayerType::LEGAL_ENTITY,
            name: new BusinessName('ACME Corp'),
            address: new Address(
                street: 'Main street',
                houseNumber: 123,
                city: new CityCode(1),
                complement1: 'Alternative street 1',
                complement2: 'Alternative street 2',
            ),
            phoneNumber: new PhoneNumber('(+595 21) 000 000'),
            emailAddress: new EmailAddress('info@email.com'),
            activities: new EconomicActivityCollection(
                new EconomicActivity('0000', 'ECONOMIC ACTIVITY')
            ),
            taxRegimeType: TaxRegimeType::SMALL_PRODUCER_REGIME,
            branchName: new BranchName('ACME Main store'),
            tradeName: new TradeName('ACME store')
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
            unitPrice: Money::guaranies('110000.0'),
            vat: new ItemVat(
                tratment: VatTreatment::VAT_TAXABLE,
                rate: new Percentage(10),
                taxableProportion: new Percentage(100)
            )
        );

        $item2 = new Item(
            description: 'Product 2',
            quantity: 1,
            unitPrice: Money::guaranies('150000.0'),
            vat: new ItemVat(
                tratment: VatTreatment::VAT_TAXABLE,
                rate: new Percentage(5),
                taxableProportion: new Percentage(100)
            )
        );

        $item3 = new Item(
            description: 'Product 3',
            quantity: 1,
            unitPrice: Money::guaranies('110000.0'),
            vat: new ItemVat(
                tratment: VatTreatment::VAT_EXEMPT,
                rate: new Percentage(0),
                taxableProportion: new Percentage(0)
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
            ->addItem($item3)
            ->build();

        return [
            'invoice' => [$invoice],
        ];
    }
}
