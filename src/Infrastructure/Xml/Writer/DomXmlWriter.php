<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Writer;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\XmlWriterInterface;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Namespace\SifenNamespaces;

final class DomXmlWriter implements XmlWriterInterface
{
    private DOMDocument $document;

    /**
     * @var array<string, DOMElement>
     */
    private array $nodes = [];

    public function startDocument(): void
    {
        $this->document = new DOMDocument('1.0', 'UTF-8');
        $this->document->formatOutput = false;
    }

    public function createRoot(string $name): void
    {
        $root = $this->document->createElementNS(
            SifenNamespaces::SIFEN,
            $name
        );

        $this->document->appendChild($root);

        $this->nodes[$name] = $root;
    }

    public function appendNode(
        string $parent,
        string $name,
        ?string $value = null,
    ): void {
        $node = $this->document->createElement(
            $name,
            Utf8Sanitizer::sanitize($value ?? '')
        );

        $this->nodes[$parent]->appendChild($node);

        $this->nodes[$name] = $node;
    }

    public function toString(): string
    {
        return $this->document->saveXML();
    }
}
