<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Tests\Unit\Infrastructure\Xml\NodeMapper;

use Nyxcode\PhpSifenTool\Domain\Common\Collection\EconomicActivityCollection;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Address;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\BusinessName;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\CityCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\CountryCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\DocumentNumber;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\EmailAddress;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\EstablishmentCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ExpeditionPoint;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\IdentityDocument;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ItemVat;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Money;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Percentage;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\PhoneNumber;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Ruc;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\SecurityCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\TaxAuthorizationNumber;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\UnitOfMeasureCode;
use Nyxcode\PhpSifenTool\Domain\DE\Builder\InvoiceBuilder;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\CashPayment;
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
use Nyxcode\PhpSifenTool\Domain\DE\Enum\IdentityDocumentType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\OperationConditionType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\OperationType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\PaymentType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\PresenceIndicator;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\ReceiverNature;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\TaxpayerType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\VatTreatment;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150\TotalsNodeMapper;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Writer\XmlTreeRenderer;
use Nyxcode\PhpSifenTool\Tests\Unit\Infrastructure\Xml\XmlTestCase;

final class TotalsNodeMapperTest extends XmlTestCase
{
    public function test_maps_mixed_rate_totals_in_field_order(): void
    {
        $invoice = self::buildInvoice([
            self::taxableItem('INT-001', '1100', 10),
            self::taxableItem('INT-002', '1073', 5),
        ]);

        $xml = $this->render($invoice);

        // Item 1: 1100 Gs @ 10% -> base 1000, IVA 100
        // Item 2: 1073 Gs @ 5%  -> base 1022, IVA 51
        // Total: 2173, floored to 2150 -> rounding 23.
        $this->assertXmlPathValue('0', '/gTotSub/dSubExe', $xml);
        $this->assertXmlPathValue('0', '/gTotSub/dSubExo', $xml);
        $this->assertXmlPathValue('1073', '/gTotSub/dSub5', $xml);
        $this->assertXmlPathValue('1100', '/gTotSub/dSub10', $xml);
        $this->assertXmlPathValue('2173', '/gTotSub/dTotOpe', $xml);
        $this->assertXmlPathValue('0', '/gTotSub/dTotDesc', $xml);
        $this->assertXmlPathValue('0', '/gTotSub/dTotDescGlotem', $xml);
        $this->assertXmlPathValue('0', '/gTotSub/dTotAntItem', $xml);
        $this->assertXmlPathValue('0', '/gTotSub/dTotAnt', $xml);
        $this->assertXmlPathValue('0', '/gTotSub/dPorcDescTotal', $xml);
        $this->assertXmlPathValue('0', '/gTotSub/dDescTotal', $xml);
        $this->assertXmlPathValue('0', '/gTotSub/dAnticipo', $xml);
        $this->assertXmlPathValue('23', '/gTotSub/dRedon', $xml);
        $this->assertXmlPathValue('2150', '/gTotSub/dTotGralOpe', $xml);
        $this->assertXmlPathValue('51', '/gTotSub/dIVA5', $xml);
        $this->assertXmlPathValue('100', '/gTotSub/dIVA10', $xml);
        $this->assertXmlPathValue('22', '/gTotSub/dLiqTotIVA5', $xml);
        $this->assertXmlPathValue('21', '/gTotSub/dLiqTotIVA10', $xml);
        $this->assertXmlPathValue('108', '/gTotSub/dTotIVA', $xml);
        $this->assertXmlPathValue('1022', '/gTotSub/dBaseGrav5', $xml);
        $this->assertXmlPathValue('1000', '/gTotSub/dBaseGrav10', $xml);
        $this->assertXmlPathValue('2022', '/gTotSub/dTBasGraIVA', $xml);

        $this->assertFieldOrder([
            'dSubExe', 'dSubExo', 'dSub5', 'dSub10', 'dTotOpe', 'dTotDesc',
            'dTotDescGlotem', 'dTotAntItem', 'dTotAnt', 'dPorcDescTotal',
            'dDescTotal', 'dAnticipo', 'dRedon', 'dTotGralOpe', 'dIVA5',
            'dIVA10', 'dLiqTotIVA5', 'dLiqTotIVA10', 'dTotIVA', 'dBaseGrav5',
            'dBaseGrav10', 'dTBasGraIVA',
        ], $xml);
    }

    /**
     * SEDECO Resolución 347/2014 rounding example: 107.437 -> 37 -> 107.400.
     */
    public function test_maps_official_rounding_example(): void
    {
        $invoice = self::buildInvoice([
            self::taxableItem('INT-001', '107437', 10),
        ]);

        $xml = $this->render($invoice);

        $this->assertXmlPathValue('37', '/gTotSub/dRedon', $xml);
        $this->assertXmlPathValue('107400', '/gTotSub/dTotGralOpe', $xml);
    }

    public function test_does_not_generate_optional_iva_fields_for_exempt_only_invoice(): void
    {
        $item = new Item(
            internalCode: 'INT-001',
            description: 'Product 1',
            quantity: 1,
            unitOfMeasureCode: new UnitOfMeasureCode(77),
            unitPrice: Money::guaranies('1000'),
            vat: new ItemVat(
                tratment: VatTreatment::VAT_EXEMPT,
                rate: new Percentage(0),
                taxableProportion: new Percentage(0)
            ),
        );

        $invoice = self::buildInvoice([$item]);

        $xml = $this->render($invoice);

        $this->assertXmlPathValue('1000', '/gTotSub/dSubExe', $xml);
        $this->assertNull($this->evaluateXPath($xml, '/gTotSub/dLiqTotIVA5'));
        $this->assertNull($this->evaluateXPath($xml, '/gTotSub/dLiqTotIVA10'));
        $this->assertNull($this->evaluateXPath($xml, '/gTotSub/dBaseGrav5'));
        $this->assertNull($this->evaluateXPath($xml, '/gTotSub/dBaseGrav10'));
        $this->assertNull($this->evaluateXPath($xml, '/gTotSub/dTBasGraIVA'));
    }

    /**
     * @param  string[]  $expectedOrder
     */
    private function assertFieldOrder(array $expectedOrder, string $xml): void
    {
        $simpleXml = new \SimpleXMLElement($xml);
        $actualOrder = array_values(array_map(
            static fn ($child) => $child->getName(),
            iterator_to_array($simpleXml->children())
        ));

        $this->assertSame($expectedOrder, $actualOrder);
    }

    private function render(ElectronicDocument $invoice): string
    {
        $tree = (new TotalsNodeMapper)->map($invoice);

        return (new XmlTreeRenderer)->render($tree);
    }

    private static function taxableItem(string $internalCode, string $unitPrice, int $rate): Item
    {
        return new Item(
            internalCode: $internalCode,
            description: 'Product',
            quantity: 1,
            unitOfMeasureCode: new UnitOfMeasureCode(77),
            unitPrice: Money::guaranies($unitPrice),
            vat: new ItemVat(
                tratment: VatTreatment::VAT_TAXABLE,
                rate: new Percentage($rate),
                taxableProportion: new Percentage(100)
            )
        );
    }

    /**
     * @param  Item[]  $items
     */
    private static function buildInvoice(array $items): ElectronicDocument
    {
        $operation = new Operation(
            EmissionType::NORMAL,
            SecurityCode::generate(),
            null,
            null
        );

        $taxAuthorization = new TaxAuthorization(
            ElectronicDocumentType::ELECTRONIC_INVOICE,
            new TaxAuthorizationNumber('12345678'),
            new EstablishmentCode('001'),
            new ExpeditionPoint('001'),
            new DocumentNumber('1234567'),
            new \DateTimeImmutable,
            null
        );

        $issuer = new Issuer(
            ruc: new Ruc('1234567', 6),
            taxpayerType: TaxpayerType::LEGAL_ENTITY,
            name: new BusinessName('ACME Corp'),
            address: new Address(
                street: 'Main street',
                houseNumber: 0,
                city: new CityCode(1),
                complement1: null,
                complement2: null,
            ),
            phoneNumber: new PhoneNumber('(+595 21) 000 000'),
            emailAddress: new EmailAddress('info@email.com'),
            activities: new EconomicActivityCollection(
                new EconomicActivity('0000', 'ECONOMIC ACTIVITY')
            ),
            taxRegimeType: null,
            branchName: null,
            tradeName: null
        );

        $receiver = new Receiver(
            nature: ReceiverNature::NON_TAXPAYER,
            operation: OperationType::B2C,
            countryCode: new CountryCode('PRY'),
            document: new IdentityDocument(IdentityDocumentType::NATIONAL_ID, '987654321'),
            legalName: 'John Doe',
            fantasyName: null,
            address: null,
            phone: null,
            cellphone: null,
            email: null,
            customerCode: null
        );

        $paymentCondition = new PaymentCondition(
            OperationConditionType::CASH,
            [new CashPayment(PaymentType::CASH, Money::guaranies('30'))]
        );

        $invoiceData = new InvoiceData(PresenceIndicator::IN_PERSON);

        $builder = InvoiceBuilder::make(new \DateTimeImmutable)
            ->operation($operation)
            ->taxAuthorization($taxAuthorization)
            ->issuer($issuer)
            ->receiver($receiver)
            ->invoiceData($invoiceData)
            ->paymentCondition($paymentCondition);

        foreach ($items as $item) {
            $builder->addItem($item);
        }

        return $builder->build();
    }
}
