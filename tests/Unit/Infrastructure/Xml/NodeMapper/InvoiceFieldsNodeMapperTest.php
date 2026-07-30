<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Tests\Unit\Infrastructure\Xml\NodeMapper;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\InvoiceData;
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
}
