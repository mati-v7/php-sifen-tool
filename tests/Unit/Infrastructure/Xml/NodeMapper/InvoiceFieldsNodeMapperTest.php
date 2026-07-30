<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Tests\Unit\Infrastructure\Xml\NodeMapper;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ContractingEntityCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ContractModalityCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ContractSequenceCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ContractYearCode;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\InvoiceData;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\PublicProcurement;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\PresenceIndicator;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150\InvoiceFieldsNodeMapper;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Writer\XmlTreeRenderer;
use Nyxcode\PhpSifenTool\Tests\Unit\Infrastructure\Xml\XmlTestCase;

final class InvoiceFieldsNodeMapperTest extends XmlTestCase
{
    public function test_maps_required_presence_fields(): void
    {
        $invoiceData = new InvoiceData(PresenceIndicator::IN_PERSON);

        $tree = (new InvoiceFieldsNodeMapper)->map($invoiceData);
        $xml = (new XmlTreeRenderer)->render($tree);

        $this->assertXmlPathValue('1', '/gCamFE/iIndPres', $xml);
        $this->assertXmlPathValue('Operación presencial', '/gCamFE/dDesIndPres', $xml);
        $this->assertNull($this->evaluateXPath($xml, '/gCamFE/dFecEmNR'));
    }

    public function test_maps_custom_presence_description_when_other(): void
    {
        $invoiceData = new InvoiceData(
            PresenceIndicator::OTHER,
            'Operación no listada'
        );

        $tree = (new InvoiceFieldsNodeMapper)->map($invoiceData);
        $xml = (new XmlTreeRenderer)->render($tree);

        $this->assertXmlPathValue('9', '/gCamFE/iIndPres', $xml);
        $this->assertXmlPathValue('Operación no listada', '/gCamFE/dDesIndPres', $xml);
    }

    public function test_maps_optional_future_delivery_date(): void
    {
        $invoiceData = new InvoiceData(
            PresenceIndicator::IN_PERSON,
            null,
            new \DateTimeImmutable('2026-08-15')
        );

        $tree = (new InvoiceFieldsNodeMapper)->map($invoiceData);
        $xml = (new XmlTreeRenderer)->render($tree);

        $this->assertXmlPathValue('2026-08-15', '/gCamFE/dFecEmNR', $xml);
    }

    public function test_maps_optional_public_procurement_data(): void
    {
        $invoiceData = new InvoiceData(
            PresenceIndicator::IN_PERSON,
            null,
            null,
            new PublicProcurement(
                new ContractModalityCode('LC'),
                new ContractingEntityCode('00001'),
                new ContractYearCode('26'),
                new ContractSequenceCode('1234567'),
                new \DateTimeImmutable('2026-07-01')
            )
        );

        $tree = (new InvoiceFieldsNodeMapper)->map($invoiceData);
        $xml = (new XmlTreeRenderer)->render($tree);

        $this->assertXmlPathValue('LC', '/gCamFE/gCompPub/dModCont', $xml);
        $this->assertXmlPathValue('00001', '/gCamFE/gCompPub/dEntCont', $xml);
        $this->assertXmlPathValue('26', '/gCamFE/gCompPub/dAnoCont', $xml);
        $this->assertXmlPathValue('1234567', '/gCamFE/gCompPub/dSecCont', $xml);
        $this->assertXmlPathValue('2026-07-01', '/gCamFE/gCompPub/dFeCodCont', $xml);
    }

    public function test_does_not_map_public_procurement_node_when_absent(): void
    {
        $invoiceData = new InvoiceData(PresenceIndicator::IN_PERSON);

        $tree = (new InvoiceFieldsNodeMapper)->map($invoiceData);
        $xml = (new XmlTreeRenderer)->render($tree);

        $this->assertNull($this->evaluateXPath($xml, '/gCamFE/gCompPub'));
    }
}
