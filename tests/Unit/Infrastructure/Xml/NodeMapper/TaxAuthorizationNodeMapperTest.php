<?php

namespace Nyxcode\PhpSifenTool\Tests\Unit\Infrastructure\Xml\NodeMapper;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\DocumentNumber;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\EstablishmentCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ExpeditionPoint;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Serie;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\TaxAuthorizationNumber;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\TaxAuthorization;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\ElectronicDocumentType;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150\TaxAuthorizationNodeMapper;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Writer\XmlTreeRenderer;
use Nyxcode\PhpSifenTool\Tests\Unit\Infrastructure\Xml\XmlTestCase;

final class TaxAuthorizationNodeMapperTest extends XmlTestCase
{

    public function test_maps_required_receiver_fields(): void
    {
        $taxAuth = new TaxAuthorization(
            ElectronicDocumentType::ELECTRONIC_INVOICE,
            new TaxAuthorizationNumber('12345678'),
            new EstablishmentCode('001'),
            new ExpeditionPoint('001'),
            new DocumentNumber('1234567'),
            new \DateTimeImmutable('2026-07-26'),
            null
        );

        $tree = new TaxAuthorizationNodeMapper()
            ->map($taxAuth);

        $xml = (new XmlTreeRenderer)
            ->render($tree);

        $this->assertXmlPathValue('1', '/gTimb/iTiDE', $xml);
        $this->assertXmlPathValue('Factura electrónica', '/gTimb/dDesTiDE', $xml);
        $this->assertXmlPathValue('12345678', '/gTimb/dNumTim', $xml);
        $this->assertXmlPathValue('001', '/gTimb/dEst', $xml);
        $this->assertXmlPathValue('001', '/gTimb/dPunExp', $xml);
        $this->assertXmlPathValue('1234567', '/gTimb/dNumDoc', $xml);
        $this->assertXmlPathValue('2026-07-26', '/gTimb/dFeIniT', $xml);
    }

    public function test_maps_serie_field(): void
    {
        $taxAuth = new TaxAuthorization(
            ElectronicDocumentType::ELECTRONIC_INVOICE,
            new TaxAuthorizationNumber('12345678'),
            new EstablishmentCode('001'),
            new ExpeditionPoint('001'),
            new DocumentNumber('1234567'),
            new \DateTimeImmutable('2026-07-26'),
            new Serie('AA')
        );

        $tree = new TaxAuthorizationNodeMapper()
            ->map($taxAuth);

        $xml = (new XmlTreeRenderer)
            ->render($tree);

        $this->assertXmlPathValue('AA', '/gTimb/dSerieNum', $xml);
    }

    public function test_does_not_generate_serie_field(): void
    {
        $taxAuth = new TaxAuthorization(
            ElectronicDocumentType::ELECTRONIC_INVOICE,
            new TaxAuthorizationNumber('12345678'),
            new EstablishmentCode('001'),
            new ExpeditionPoint('001'),
            new DocumentNumber('1234567'),
            new \DateTimeImmutable('2026-07-26'),
            null
        );

        $tree = new TaxAuthorizationNodeMapper()
            ->map($taxAuth);

        $xml = (new XmlTreeRenderer)
            ->render($tree);

        $this->assertNull($this->evaluateXPath($xml, '/gTimb/dSerieNum'));
    }
}
