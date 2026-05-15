<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Tests\Unit\Infrastructure\Xml\Writer;

use Nyxcode\PhpSifenTool\Infrastructure\Xml\Writer\DomXmlWriter;
use PHPUnit\Framework\TestCase;

final class DomXmlWriterTest extends TestCase
{
    public function test_it_creates_xml_document(): void
    {
        $writer = new DomXmlWriter;
        $writer->startDocument();
        $writer->createRoot('TestRoot');
        $writer->appendNode('TestRoot', 'ChildNode', 'ChildValue');

        $xmlString = $writer->toString();

        $this->assertStringContainsString('TestRoot', $xmlString);
        $this->assertStringContainsString('<ChildNode>ChildValue</ChildNode>', $xmlString);
    }
}
