<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Tests\Unit\Infrastructure\Xml\Generator;

use Nyxcode\PhpSifenTool\Domain\Common\Collection\EconomicActivityCollection;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Address;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\BranchName;
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
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\TradeName;
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
use Nyxcode\PhpSifenTool\Domain\DE\Enum\RelevantMerchandiseDataCode;
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
        $this->assertStringContainsString('<gDtipDE>', $xmlString);
        $this->assertStringContainsString('<gCamFE>', $xmlString);
        $this->assertStringContainsString('<iIndPres>1</iIndPres>', $xmlString);
        $this->assertStringContainsString('<dDesIndPres>Operación presencial</dDesIndPres>', $xmlString);
        $this->assertStringContainsString('<gCamCond>', $xmlString);
        $this->assertStringContainsString('<iCondOpe>1</iCondOpe>', $xmlString);
        $this->assertStringContainsString('<dDCondOpe>Contado</dDCondOpe>', $xmlString);
        $this->assertStringContainsString('<gPaConEIni>', $xmlString);
        $this->assertStringContainsString('<iTiPago>1</iTiPago>', $xmlString);
        $this->assertStringContainsString('<dDesTiPag>Efectivo</dDesTiPag>', $xmlString);
        $this->assertStringContainsString('<dMonTiPag>480000</dMonTiPag>', $xmlString);
        $this->assertStringContainsString('<cMoneTiPag>PYG</cMoneTiPag>', $xmlString);
        $this->assertStringContainsString('<dDMoneTiPag>Guarani</dDMoneTiPag>', $xmlString);
        $this->assertStringContainsString('<gCamItem>', $xmlString);
        $this->assertStringContainsString('<dCodInt>INT-001</dCodInt>', $xmlString);
        $this->assertStringContainsString('<dDesProSer>Product 1</dDesProSer>', $xmlString);
        $this->assertStringContainsString('<cUniMed>77</cUniMed>', $xmlString);
        $this->assertStringContainsString('<dDesUniMed>UNI</dDesUniMed>', $xmlString);
        $this->assertStringContainsString('<dCantProSer>2</dCantProSer>', $xmlString);
        $this->assertStringContainsString('<cPaisOrig>PRY</cPaisOrig>', $xmlString);
        $this->assertStringContainsString('<dDesPaisOrig>Paraguay</dDesPaisOrig>', $xmlString);
        $this->assertStringContainsString('<cRelMerc>1</cRelMerc>', $xmlString);
        $this->assertStringContainsString('<dDesRelMerc>Tolerancia de quiebra</dDesRelMerc>', $xmlString);
        $this->assertStringContainsString('<dCanQuiMer>0.5</dCanQuiMer>', $xmlString);
        $this->assertStringContainsString('<dPorQuiMer>1.5</dPorQuiMer>', $xmlString);
        $this->assertStringContainsString('<dPUniProSer>110000</dPUniProSer>', $xmlString);
        $this->assertStringContainsString('<dTotOpeItem>220000</dTotOpeItem>', $xmlString);
        $this->assertStringContainsString('<dDesProSer>Product 2</dDesProSer>', $xmlString);
        $this->assertStringContainsString('<dCantProSer>1</dCantProSer>', $xmlString);
        $this->assertStringContainsString('<dPUniProSer>150000</dPUniProSer>', $xmlString);
        $this->assertStringContainsString('<dTotOpeItem>150000</dTotOpeItem>', $xmlString);
        $this->assertStringContainsString('<gTotSub>', $xmlString);
        $this->assertStringContainsString('<dTotGralOpe>480000</dTotGralOpe>', $xmlString);
    }

    public function test_generate_includes_item_pricing_group_fields(): void
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
                houseNumber: 123,
                complement1: null,
                complement2: null,
                city: new CityCode(1),
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
            [new CashPayment(PaymentType::CASH, Money::guaranies('160000'))]
        );

        $item = new Item(
            internalCode: 'INT-001',
            description: 'Product with discounts',
            quantity: 1,
            unitOfMeasureCode: new UnitOfMeasureCode(77),
            unitPrice: Money::guaranies('200000'),
            vat: new ItemVat(
                tratment: VatTreatment::VAT_TAXABLE,
                rate: new Percentage(10),
                taxableProportion: new Percentage(100)
            ),
            discount: Money::guaranies('20000'),
            globalDiscount: Money::guaranies('10000'),
            advancePayment: Money::guaranies('5000'),
            globalAdvancePayment: Money::guaranies('5000'),
            exchangeRate: 7300.5,
        );

        $invoice = InvoiceBuilder::make(new \DateTimeImmutable)
            ->operation($operation)
            ->taxAuthorization($taxAuthorization)
            ->issuer($issuer)
            ->receiver($receiver)
            ->invoiceData(new InvoiceData(PresenceIndicator::IN_PERSON))
            ->paymentCondition($paymentCondition)
            ->addItem($item)
            ->build();

        $xmlString = (new InvoiceXmlGenerator)->generate($invoice);

        $this->assertStringContainsString('<gValorItem>', $xmlString);
        $this->assertStringContainsString('<dPUniProSer>200000</dPUniProSer>', $xmlString);
        $this->assertStringContainsString('<dTiCamIt>7300.5</dTiCamIt>', $xmlString);
        $this->assertStringContainsString('<dTotBruOpeItem>200000</dTotBruOpeItem>', $xmlString);
        $this->assertStringContainsString('<gValorRestaItem>', $xmlString);
        $this->assertStringContainsString('<dDescItem>20000</dDescItem>', $xmlString);
        $this->assertStringContainsString('<dPorcDesIt>10.00000000</dPorcDesIt>', $xmlString);
        $this->assertStringContainsString('<dDescGloItem>10000</dDescGloItem>', $xmlString);
        $this->assertStringContainsString('<dAntPreUniIt>5000</dAntPreUniIt>', $xmlString);
        $this->assertStringContainsString('<dAntGloPreUniIt>5000</dAntGloPreUniIt>', $xmlString);
        // (200000 - 20000 - 10000 - 5000 - 5000) * 1 = 160000
        $this->assertStringContainsString('<dTotOpeItem>160000</dTotOpeItem>', $xmlString);
        // 160000 * 7300.5 = 1168080000
        $this->assertStringContainsString('<dTotOpeGs>1168080000</dTotOpeGs>', $xmlString);
    }

    public function test_generate_includes_vat_group_fields(): void
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
                houseNumber: 123,
                complement1: null,
                complement2: null,
                city: new CityCode(1),
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
            [new CashPayment(PaymentType::CASH, Money::guaranies('210000'))]
        );

        $partiallyTaxableItem = new Item(
            internalCode: 'INT-001',
            description: 'Partially taxable product',
            quantity: 1,
            unitOfMeasureCode: new UnitOfMeasureCode(77),
            unitPrice: Money::guaranies('100000'),
            vat: new ItemVat(
                tratment: VatTreatment::VAT_PARTIALLY_TAXABLE,
                rate: new Percentage(10),
                taxableProportion: new Percentage(30)
            ),
        );

        $exoneratedItem = new Item(
            internalCode: 'INT-002',
            description: 'Exonerated product',
            quantity: 1,
            unitOfMeasureCode: new UnitOfMeasureCode(77),
            unitPrice: Money::guaranies('110000'),
            vat: new ItemVat(
                tratment: VatTreatment::VAT_EXONERATED,
                rate: new Percentage(0),
                taxableProportion: new Percentage(100)
            ),
        );

        $invoice = InvoiceBuilder::make(new \DateTimeImmutable)
            ->operation($operation)
            ->taxAuthorization($taxAuthorization)
            ->issuer($issuer)
            ->receiver($receiver)
            ->invoiceData(new InvoiceData(PresenceIndicator::IN_PERSON))
            ->paymentCondition($paymentCondition)
            ->addItem($partiallyTaxableItem)
            ->addItem($exoneratedItem)
            ->build();

        $xmlString = (new InvoiceXmlGenerator)->generate($invoice);

        $this->assertStringContainsString('<gCamIVA>', $xmlString);
        $this->assertStringContainsString('<iAfecIVA>4</iAfecIVA>', $xmlString);
        $this->assertStringContainsString('<dDesAfecIVA>Gravado parcial (Grav-Exento)</dDesAfecIVA>', $xmlString);
        $this->assertStringContainsString('<dPropIVA>30</dPropIVA>', $xmlString);
        $this->assertStringContainsString('<dTasaIVA>10</dTasaIVA>', $xmlString);
        // (100000 * (30/100)) / 1.1 = 27272.72..., rounds half up to 27273
        $this->assertStringContainsString('<dBasGravIVA>27273</dBasGravIVA>', $xmlString);
        // 27273 * (10/100) = 2727.3, rounds half up to 2727
        $this->assertStringContainsString('<dLiqIVAItem>2727</dLiqIVAItem>', $xmlString);

        $this->assertStringContainsString('<iAfecIVA>2</iAfecIVA>', $xmlString);
        $this->assertStringContainsString('<dDesAfecIVA>Exonerado (Art. 83- Ley 125/91)</dDesAfecIVA>', $xmlString);
        $this->assertStringContainsString('<dTasaIVA>0</dTasaIVA>', $xmlString);
        $this->assertStringContainsString('<dBasGravIVA>0</dBasGravIVA>', $xmlString);
        $this->assertStringContainsString('<dLiqIVAItem>0</dLiqIVAItem>', $xmlString);
    }

    public function test_generate_defaults_item_discount_and_advance_payment_to_zero(): void
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
                houseNumber: 123,
                complement1: null,
                complement2: null,
                city: new CityCode(1),
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
            [new CashPayment(PaymentType::CASH, Money::guaranies('100000'))]
        );

        $item = new Item(
            internalCode: 'INT-001',
            description: 'Product without discounts',
            quantity: 1,
            unitOfMeasureCode: new UnitOfMeasureCode(77),
            unitPrice: Money::guaranies('100000'),
            vat: new ItemVat(
                tratment: VatTreatment::VAT_TAXABLE,
                rate: new Percentage(10),
                taxableProportion: new Percentage(100)
            ),
        );

        $invoice = InvoiceBuilder::make(new \DateTimeImmutable)
            ->operation($operation)
            ->taxAuthorization($taxAuthorization)
            ->issuer($issuer)
            ->receiver($receiver)
            ->invoiceData(new InvoiceData(PresenceIndicator::IN_PERSON))
            ->paymentCondition($paymentCondition)
            ->addItem($item)
            ->build();

        $xmlString = (new InvoiceXmlGenerator)->generate($invoice);

        $this->assertStringContainsString('<dDescItem>0</dDescItem>', $xmlString);
        $this->assertStringContainsString('<dAntPreUniIt>0</dAntPreUniIt>', $xmlString);
        $this->assertStringContainsString('<dAntGloPreUniIt>0</dAntGloPreUniIt>', $xmlString);
        $this->assertStringNotContainsString('<dPorcDesIt>', $xmlString);
        $this->assertStringNotContainsString('<dDescGloItem>', $xmlString);
        $this->assertStringNotContainsString('<dTiCamIt>', $xmlString);
        $this->assertStringNotContainsString('<dTotOpeGs>', $xmlString);
    }

    public static function buildSampleInvoice(): array
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
            [new CashPayment(PaymentType::CASH, Money::guaranies('480000'))]
        );
        $invoiceData = new InvoiceData(PresenceIndicator::IN_PERSON);

        $item1 = new Item(
            internalCode: 'INT-001',
            description: 'Product 1',
            quantity: 2,
            unitOfMeasureCode: new UnitOfMeasureCode(77),
            unitPrice: Money::guaranies('110000.0'),
            vat: new ItemVat(
                tratment: VatTreatment::VAT_TAXABLE,
                rate: new Percentage(10),
                taxableProportion: new Percentage(100)
            ),
            originCountry: new CountryCode('PRY'),
            relevantMerchandiseData: RelevantMerchandiseDataCode::BREAKAGE_TOLERANCE,
            breakageOrShrinkageQuantity: 0.5,
            breakageOrShrinkagePercentage: 1.5,
        );

        $item2 = new Item(
            internalCode: 'INT-002',
            description: 'Product 2',
            quantity: 1,
            unitOfMeasureCode: new UnitOfMeasureCode(77),
            unitPrice: Money::guaranies('150000.0'),
            vat: new ItemVat(
                tratment: VatTreatment::VAT_TAXABLE,
                rate: new Percentage(5),
                taxableProportion: new Percentage(100)
            )
        );

        $item3 = new Item(
            internalCode: 'INT-003',
            description: 'Product 3',
            quantity: 1,
            unitOfMeasureCode: new UnitOfMeasureCode(77),
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
