<?php

namespace Nyxcode\PhpSifenTool\Tests\Unit\Infrastructure\Xml\NodeMapper;

use Nyxcode\PhpSifenTool\Domain\Common\Collection\EconomicActivityCollection;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Address;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\BusinessName;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\CityCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\EmailAddress;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\PhoneNumber;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Ruc;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\EconomicActivity;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Issuer;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\TaxpayerType;
use Nyxcode\PhpSifenTool\Infrastructure\Catalog\Geographic\JsonGeographicCatalog;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150\IssuerNodeMapper;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Writer\XmlTreeRenderer;
use Nyxcode\PhpSifenTool\Tests\Unit\Infrastructure\Xml\XmlTestCase;
use Override;

final class IssuerNodeMapperTest extends XmlTestCase
{
    private JsonGeographicCatalog $geographicCatalog;

    #[Override]
    protected function setUp(): void
    {
        parent::setUp();

        $catalogDirectory = dirname(__DIR__, 4) . '/Fixtures/catalog';
        $this->geographicCatalog = new JsonGeographicCatalog($catalogDirectory);
    }

    public function test_maps_required_issuer_fields(): void
    {
        $issuer = new Issuer(
            new Ruc('80000000', 0),
            TaxpayerType::LEGAL_ENTITY,
            null,
            new BusinessName('Acme Corp.'),
            null,
            null,
            new Address(
                'Main street',
                123,
                null,
                null,
                new CityCode(2301)
            ),
            new PhoneNumber('0900 000 000'),
            new EmailAddress('email@example.com'),
            new EconomicActivityCollection(
                new EconomicActivity('1234', 'Economic Activity'),
                new EconomicActivity('5678', 'Another Economic Activity'),
            )
        );
        $issuerMapper = new IssuerNodeMapper($this->geographicCatalog);

        $tree = $issuerMapper->map($issuer);
        $xml = (new XmlTreeRenderer)
            ->render($tree);

        $this->assertXmlPathValue('80000000', '/gEmis/dRucEm', $xml);
        $this->assertXmlPathValue('0', '/gEmis/dDVEmi', $xml);
        $this->assertXmlPathValue('2', '/gEmis/iTipCont', $xml);
        $this->assertXmlPathValue('Acme Corp.', '/gEmis/dNomEmi', $xml);
        $this->assertXmlPathValue('Main street', '/gEmis/dDirEmi', $xml);
        $this->assertXmlPathValue('123', '/gEmis/dNumCas', $xml);
        $this->assertXmlPathValue('11', '/gEmis/cDepEmi', $xml);
        $this->assertXmlPathValue('CENTRAL', '/gEmis/dDesDepEmi', $xml);
        $this->assertXmlPathValue('230', '/gEmis/cDisEmi', $xml);
        $this->assertXmlPathValue('FERNANDO DE LA MORA', '/gEmis/dDesDisEmi', $xml);
        $this->assertXmlPathValue('2301', '/gEmis/cCiuEmi', $xml);
        $this->assertXmlPathValue('FERNANDO DE LA MORA', '/gEmis/dDesCiuEmi', $xml);
        $this->assertXmlPathValue('0900 000 000', '/gEmis/dTelEmi', $xml);
        $this->assertXmlPathValue('email@example.com', '/gEmis/dEmailE', $xml);
        $this->assertNotNull($this->evaluateXPath($xml, '/gEmis/gActEco'));
        $this->assertXmlPathValue('1234', '/gEmis/gActEco/cActEco', $xml);
        $this->assertXmlPathValue('Economic Activity', '/gEmis/gActEco/dDesActEco', $xml);
    }
}
