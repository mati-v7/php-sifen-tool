<?php

namespace Nyxcode\PhpSifenTool\Tests\Unit\Infrastructure\Xml\NodeMapper;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Address;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\CityCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\CountryCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\CustomerCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\IdentityDocument;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\PhoneNumber;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Ruc;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\TaxpayerDocument;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Receiver;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\IdentityDocumentType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\OperationType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\ReceiverNature;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\TaxpayerType;
use Nyxcode\PhpSifenTool\Infrastructure\Catalog\Country\JsonCountryCatalog;
use Nyxcode\PhpSifenTool\Infrastructure\Catalog\Geographic\JsonGeographicCatalog;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150\Composite\CompositeReceiverDocumentNodeMapper;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150\IdentityDocumentNodeMapper;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150\ReceiverAddressNodeMapper;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150\ReceiverContactNodeMapper;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150\ReceiverNodeMapper;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150\TaxpayerDocumentNodeMapper;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Writer\XmlTreeRenderer;
use Nyxcode\PhpSifenTool\Tests\Unit\Infrastructure\Xml\XmlTestCase;
use Override;

final class ReceiverNodeMapperTest extends XmlTestCase
{
    private JsonCountryCatalog $countryCatalog;

    private JsonGeographicCatalog $geographicCatalog;

    #[Override]
    protected function setUp(): void
    {
        parent::setUp();

        $catalogDirectory = dirname(__DIR__, 4).'/Fixtures/catalog';
        $this->countryCatalog = new JsonCountryCatalog($catalogDirectory);
        $this->geographicCatalog = new JsonGeographicCatalog($catalogDirectory);
    }

    public function test_maps_required_receiver_fields(): void
    {

        $receiver = new Receiver(
            nature: ReceiverNature::TAXPAYER,
            operation: OperationType::B2B,
            countryCode: new CountryCode('PRY'),
            document: new TaxpayerDocument(
                ruc: new Ruc('8000000', 0),
                taxpayerType: TaxpayerType::LEGAL_ENTITY
            ),
            legalName: 'ACME Corp',
            fantasyName: null,
            address: null,
            phone: null,
            cellphone: null,
            email: null,
            customerCode: null
        );

        $receiverNode = new ReceiverNodeMapper(
            $this->countryCatalog,
            $this->geographicCatalog,
            new CompositeReceiverDocumentNodeMapper([
                new TaxpayerDocumentNodeMapper,
            ]),
            new ReceiverAddressNodeMapper,
            new ReceiverContactNodeMapper
        );

        $tree = $receiverNode->map($receiver);
        $xml = (new XmlTreeRenderer)
            ->render($tree);

        $this->assertXmlPathValue('1', '/gDatRec/iNatRec', $xml);
        $this->assertXmlPathValue('1', '/gDatRec/iTiOpe', $xml);
        $this->assertXmlPathValue('PRY', '/gDatRec/cPaisRec', $xml);
        $this->assertXmlPathValue('Paraguay', '/gDatRec/dDesPaisRe', $xml);
        $this->assertXmlPathValue('ACME Corp', '/gDatRec/dNomRec', $xml);
    }

    public function test_does_not_write_taxpayer_type_for_non_contributor(): void
    {

        $receiver = new Receiver(
            nature: ReceiverNature::NON_TAXPAYER,
            operation: OperationType::B2B,
            countryCode: new CountryCode('PRY'),
            document: new TaxpayerDocument(
                ruc: new Ruc('8000000', 0),
                taxpayerType: TaxpayerType::LEGAL_ENTITY
            ),
            legalName: 'ACME Corp',
            fantasyName: null,
            address: null,
            phone: null,
            cellphone: null,
            email: null,
            customerCode: null
        );

        $receiverNode = new ReceiverNodeMapper(
            $this->countryCatalog,
            $this->geographicCatalog,
            new CompositeReceiverDocumentNodeMapper([
                new TaxpayerDocumentNodeMapper,
            ]),
            new ReceiverAddressNodeMapper,
            new ReceiverContactNodeMapper
        );

        $tree = $receiverNode->map($receiver);
        $xml = (new XmlTreeRenderer)
            ->render($tree);

        $this->assertNull($this->evaluateXPath($xml, '/gDatRec/iTiContRec'));
    }

    public function test_maps_ruc(): void
    {
        $receiver = new Receiver(
            nature: ReceiverNature::TAXPAYER,
            operation: OperationType::B2B,
            countryCode: new CountryCode('PRY'),
            document: new TaxpayerDocument(
                ruc: new Ruc('8000000', 0),
                taxpayerType: TaxpayerType::LEGAL_ENTITY
            ),
            legalName: 'ACME Corp',
            fantasyName: null,
            address: null,
            phone: null,
            cellphone: null,
            email: null,
            customerCode: null
        );

        $receiverNode = new ReceiverNodeMapper(
            $this->countryCatalog,
            $this->geographicCatalog,
            new CompositeReceiverDocumentNodeMapper([
                new TaxpayerDocumentNodeMapper,
            ]),
            new ReceiverAddressNodeMapper,
            new ReceiverContactNodeMapper
        );

        $tree = $receiverNode->map($receiver);
        $xml = (new XmlTreeRenderer)
            ->render($tree);

        $this->assertXmlPathValue('2', '/gDatRec/iTiContRec', $xml);
        $this->assertXmlPathValue('8000000', '/gDatRec/dRucRec', $xml);
        $this->assertXmlPathValue('0', '/gDatRec/dDVRuc', $xml);
    }

    public function test_does_not_generate_identity_fields(): void
    {
        $receiver = new Receiver(
            nature: ReceiverNature::TAXPAYER,
            operation: OperationType::B2B,
            countryCode: new CountryCode('PRY'),
            document: new TaxpayerDocument(
                ruc: new Ruc('8000000', 0),
                taxpayerType: TaxpayerType::LEGAL_ENTITY
            ),
            legalName: 'ACME Corp',
            fantasyName: null,
            address: null,
            phone: null,
            cellphone: null,
            email: null,
            customerCode: null
        );

        $receiverNode = new ReceiverNodeMapper(
            $this->countryCatalog,
            $this->geographicCatalog,
            new CompositeReceiverDocumentNodeMapper([
                new TaxpayerDocumentNodeMapper,
                new IdentityDocumentNodeMapper,
            ]),
            new ReceiverAddressNodeMapper,
            new ReceiverContactNodeMapper
        );

        $tree = $receiverNode->map($receiver);
        $xml = (new XmlTreeRenderer)
            ->render($tree);

        $this->assertNull($this->evaluateXPath($xml, '/gDatRec/dDTipIDRec'));
        $this->assertNull($this->evaluateXPath($xml, '/gDatRec/dNumIDRec'));
    }

    public function test_maps_paraguayan_identity_card(): void
    {
        $receiver = new Receiver(
            nature: ReceiverNature::NON_TAXPAYER,
            operation: OperationType::B2C,
            countryCode: new CountryCode('PRY'),
            document: new IdentityDocument(
                IdentityDocumentType::NATIONAL_ID,
                '1234567'
            ),
            legalName: 'Jhon Doe',
            fantasyName: null,
            address: null,
            phone: null,
            cellphone: null,
            email: null,
            customerCode: null
        );

        $receiverNode = new ReceiverNodeMapper(
            $this->countryCatalog,
            $this->geographicCatalog,
            new CompositeReceiverDocumentNodeMapper([
                new TaxpayerDocumentNodeMapper,
                new IdentityDocumentNodeMapper,
            ]),
            new ReceiverAddressNodeMapper,
            new ReceiverContactNodeMapper
        );

        $tree = $receiverNode->map($receiver);
        $xml = (new XmlTreeRenderer)
            ->render($tree);

        $this->assertXmlPathValue('1', '/gDatRec/iTipIDRec', $xml);
        $this->assertXmlPathValue('Cédula paraguaya', '/gDatRec/dDTipIDRec', $xml);
        $this->assertXmlPathValue('1234567', '/gDatRec/dNumIDRec', $xml);
    }

    public function test_maps_undefined_identity(): void
    {
        $receiver = new Receiver(
            nature: ReceiverNature::NON_TAXPAYER,
            operation: OperationType::B2C,
            countryCode: new CountryCode('PRY'),
            document: new IdentityDocument(
                IdentityDocumentType::UNIDENTIFIED,
                '1234567'
            ),
            legalName: 'Jhon Doe',
            fantasyName: null,
            address: null,
            phone: null,
            cellphone: null,
            email: null,
            customerCode: null
        );

        $receiverNode = new ReceiverNodeMapper(
            $this->countryCatalog,
            $this->geographicCatalog,
            new CompositeReceiverDocumentNodeMapper([
                new TaxpayerDocumentNodeMapper,
                new IdentityDocumentNodeMapper,
            ]),
            new ReceiverAddressNodeMapper,
            new ReceiverContactNodeMapper
        );

        $tree = $receiverNode->map($receiver);
        $xml = (new XmlTreeRenderer)
            ->render($tree);

        $this->assertXmlPathValue('5', '/gDatRec/iTipIDRec', $xml);
        $this->assertXmlPathValue('Innominado', '/gDatRec/dDTipIDRec', $xml);
        $this->assertXmlPathValue('0', '/gDatRec/dNumIDRec', $xml);
        $this->assertXmlPathValue('Sin Nombre', '/gDatRec/dNomRec', $xml);
    }

    public function test_does_not_generate_identity_document_for_b2f(): void
    {
        $receiver = new Receiver(
            nature: ReceiverNature::NON_TAXPAYER,
            operation: OperationType::B2F,
            countryCode: new CountryCode('PRY'),
            document: new IdentityDocument(
                IdentityDocumentType::FOREIGN_ID,
                '1234567'
            ),
            legalName: 'Jhon Doe',
            fantasyName: null,
            address: null,
            phone: null,
            cellphone: null,
            email: null,
            customerCode: null
        );

        $receiverNode = new ReceiverNodeMapper(
            $this->countryCatalog,
            $this->geographicCatalog,
            new CompositeReceiverDocumentNodeMapper([
                new TaxpayerDocumentNodeMapper,
                new IdentityDocumentNodeMapper,
            ]),
            new ReceiverAddressNodeMapper,
            new ReceiverContactNodeMapper
        );

        $tree = $receiverNode->map($receiver);
        $xml = (new XmlTreeRenderer)
            ->render($tree);

        $this->assertNull($this->evaluateXPath($xml, '/gDatRec/iTipIDRec'));
        $this->assertNull($this->evaluateXPath($xml, '/gDatRec/dDTipIDRec'));
        $this->assertNull($this->evaluateXPath($xml, '/gDatRec/dNumIDRec'));
    }

    public function test_maps_fantasy_name_when_present(): void
    {
        $receiver = new Receiver(
            nature: ReceiverNature::NON_TAXPAYER,
            operation: OperationType::B2B,
            countryCode: new CountryCode('PRY'),
            document: new TaxpayerDocument(
                ruc: new Ruc('8000000', 0),
                taxpayerType: TaxpayerType::LEGAL_ENTITY
            ),
            legalName: 'ACME Corp',
            fantasyName: 'ACME',
            address: null,
            phone: null,
            cellphone: null,
            email: null,
            customerCode: null
        );

        $receiverNode = new ReceiverNodeMapper(
            $this->countryCatalog,
            $this->geographicCatalog,
            new CompositeReceiverDocumentNodeMapper([
                new TaxpayerDocumentNodeMapper,
            ]),
            new ReceiverAddressNodeMapper,
            new ReceiverContactNodeMapper
        );

        $tree = $receiverNode->map($receiver);
        $xml = (new XmlTreeRenderer)
            ->render($tree);

        $this->assertXmlPathValue('ACME', '/gDatRec/dNomFanRec', $xml);
    }

    public function test_maps_customer_code(): void
    {
        $receiver = new Receiver(
            nature: ReceiverNature::NON_TAXPAYER,
            operation: OperationType::B2B,
            countryCode: new CountryCode('PRY'),
            document: new TaxpayerDocument(
                ruc: new Ruc('8000000', 0),
                taxpayerType: TaxpayerType::LEGAL_ENTITY
            ),
            legalName: 'ACME Corp',
            fantasyName: 'ACME',
            address: null,
            phone: null,
            cellphone: null,
            email: null,
            customerCode: new CustomerCode('XXX123')
        );

        $receiverNode = new ReceiverNodeMapper(
            $this->countryCatalog,
            $this->geographicCatalog,
            new CompositeReceiverDocumentNodeMapper([
                new TaxpayerDocumentNodeMapper,
            ]),
            new ReceiverAddressNodeMapper,
            new ReceiverContactNodeMapper
        );

        $tree = $receiverNode->map($receiver);
        $xml = (new XmlTreeRenderer)
            ->render($tree);

        $this->assertXmlPathValue('XXX123', '/gDatRec/dCodCliente', $xml);
    }

    public function test_maps_complete_paraguayan_address(): void
    {
        $receiver = new Receiver(
            nature: ReceiverNature::TAXPAYER,
            operation: OperationType::B2B,
            countryCode: new CountryCode('PRY'),
            document: new TaxpayerDocument(
                ruc: new Ruc('8000000', 0),
                taxpayerType: TaxpayerType::LEGAL_ENTITY
            ),
            legalName: 'ACME Corp',
            fantasyName: 'ACME',
            address: new Address(
                'Main street',
                123,
                null,
                null,
                new CityCode(2301)
            ),
            phone: null,
            cellphone: null,
            email: null,
            customerCode: null
        );

        $receiverNode = new ReceiverNodeMapper(
            $this->countryCatalog,
            $this->geographicCatalog,
            new CompositeReceiverDocumentNodeMapper([
                new TaxpayerDocumentNodeMapper,
            ]),
            new ReceiverAddressNodeMapper,
            new ReceiverContactNodeMapper
        );

        $tree = $receiverNode->map($receiver);
        $xml = (new XmlTreeRenderer)
            ->render($tree);

        $this->assertXmlPathValue('Main street', '/gDatRec/dDirRec', $xml);
        $this->assertXmlPathValue('123', '/gDatRec/dNumCasRec', $xml);
        $this->assertXmlPathValue('11', '/gDatRec/cDepRec', $xml);
        $this->assertXmlPathValue('CENTRAL', '/gDatRec/dDesDepRec', $xml);
        $this->assertXmlPathValue('230', '/gDatRec/cDisRec', $xml);
        $this->assertXmlPathValue('FERNANDO DE LA MORA', '/gDatRec/dDesDisRec', $xml);
        $this->assertXmlPathValue('2301', '/gDatRec/cCiuRec', $xml);
        $this->assertXmlPathValue('FERNANDO DE LA MORA', '/gDatRec/dDesCiuRec', $xml);
    }

    public function test_maps_foreign_address(): void
    {
        $receiver = new Receiver(
            nature: ReceiverNature::NON_TAXPAYER,
            operation: OperationType::B2F,
            countryCode: new CountryCode('ARG'),
            document: new IdentityDocument(
                IdentityDocumentType::FOREIGN_ID,
                '1234567'
            ),
            legalName: 'Jhon Doe',
            fantasyName: null,
            address: new Address(
                'Main street',
                123,
                null,
                null,
                new CityCode(2301)
            ),
            phone: null,
            cellphone: null,
            email: null,
            customerCode: null
        );

        $receiverNode = new ReceiverNodeMapper(
            $this->countryCatalog,
            $this->geographicCatalog,
            new CompositeReceiverDocumentNodeMapper([
                new TaxpayerDocumentNodeMapper,
                new IdentityDocumentNodeMapper,
            ]),
            new ReceiverAddressNodeMapper,
            new ReceiverContactNodeMapper
        );

        $tree = $receiverNode->map($receiver);
        $xml = (new XmlTreeRenderer)
            ->render($tree);

        $this->assertXmlPathValue('Main street', '/gDatRec/dDirRec', $xml);
        $this->assertXmlPathValue('123', '/gDatRec/dNumCasRec', $xml);
        $this->assertNull($this->evaluateXPath($xml, '/gDatRec/cDepRec'));
        $this->assertNull($this->evaluateXPath($xml, '/gDatRec/cDisRec'));
        $this->assertNull($this->evaluateXPath($xml, '/gDatRec/cCiuRec'));
    }

    public function test_does_not_generate_address(): void
    {
        $receiver = new Receiver(
            nature: ReceiverNature::NON_TAXPAYER,
            operation: OperationType::B2C,
            countryCode: new CountryCode('PRY'),
            document: new IdentityDocument(
                IdentityDocumentType::NATIONAL_ID,
                '1234567'
            ),
            legalName: 'Jhon Doe',
            fantasyName: null,
            address: null,
            phone: null,
            cellphone: null,
            email: null,
            customerCode: null
        );

        $receiverNode = new ReceiverNodeMapper(
            $this->countryCatalog,
            $this->geographicCatalog,
            new CompositeReceiverDocumentNodeMapper([
                new TaxpayerDocumentNodeMapper,
                new IdentityDocumentNodeMapper,
            ]),
            new ReceiverAddressNodeMapper,
            new ReceiverContactNodeMapper
        );

        $tree = $receiverNode->map($receiver);
        $xml = (new XmlTreeRenderer)
            ->render($tree);

        $this->assertNull($this->evaluateXPath($xml, '/gDatRec/dDirRec'));
        $this->assertNull($this->evaluateXPath($xml, '/gDatRec/dNumCasRec'));
        $this->assertNull($this->evaluateXPath($xml, '/gDatRec/cDepRec'));
        $this->assertNull($this->evaluateXPath($xml, '/gDatRec/cDisRec'));
        $this->assertNull($this->evaluateXPath($xml, '/gDatRec/cCiuRec'));
    }

    public function test_maps_phone_only(): void
    {
        $receiver = new Receiver(
            nature: ReceiverNature::NON_TAXPAYER,
            operation: OperationType::B2C,
            countryCode: new CountryCode('PRY'),
            document: new IdentityDocument(
                IdentityDocumentType::NATIONAL_ID,
                '1234567'
            ),
            legalName: 'Jhon Doe',
            fantasyName: null,
            address: null,
            phone: new PhoneNumber('021 000 000'),
            cellphone: null,
            email: null,
            customerCode: null
        );

        $receiverNode = new ReceiverNodeMapper(
            $this->countryCatalog,
            $this->geographicCatalog,
            new CompositeReceiverDocumentNodeMapper([
                new TaxpayerDocumentNodeMapper,
                new IdentityDocumentNodeMapper,
            ]),
            new ReceiverAddressNodeMapper,
            new ReceiverContactNodeMapper
        );

        $tree = $receiverNode->map($receiver);
        $xml = (new XmlTreeRenderer)
            ->render($tree);

        $this->assertXmlPathValue('021 000 000', '/gDatRec/dTelRec', $xml);
    }

    public function test_maps_phone_and_mobile(): void
    {
        $receiver = new Receiver(
            nature: ReceiverNature::NON_TAXPAYER,
            operation: OperationType::B2C,
            countryCode: new CountryCode('PRY'),
            document: new IdentityDocument(
                IdentityDocumentType::NATIONAL_ID,
                '1234567'
            ),
            legalName: 'Jhon Doe',
            fantasyName: null,
            address: null,
            phone: new PhoneNumber('021 000 000'),
            cellphone: new PhoneNumber('0900 000 000'),
            email: null,
            customerCode: null
        );

        $receiverNode = new ReceiverNodeMapper(
            $this->countryCatalog,
            $this->geographicCatalog,
            new CompositeReceiverDocumentNodeMapper([
                new TaxpayerDocumentNodeMapper,
                new IdentityDocumentNodeMapper,
            ]),
            new ReceiverAddressNodeMapper,
            new ReceiverContactNodeMapper
        );

        $tree = $receiverNode->map($receiver);
        $xml = (new XmlTreeRenderer)
            ->render($tree);

        $this->assertXmlPathValue('021 000 000', '/gDatRec/dTelRec', $xml);
        $this->assertXmlPathValue('0900 000 000', '/gDatRec/dCelRec', $xml);
    }
}
