<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Writer;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;

final class XmlTreeRenderer
{
    private DOMDocument $document;

    public function render(XmlElement $root): string
    {
        $this->document = new DOMDocument(
            '1.0',
            'UTF-8'
        );

        $this->document->formatOutput = false;

        $element = $this->buildElement($root);

        $this->document->appendChild($element);

        return $this->document->saveXML();
    }

    private function buildElement(
        XmlElement $node
    ): DOMElement {
        $element = $this->document->createElement(
            $node->name()
        );

        foreach ($node->attributes() as $attribute) {
            $element->setAttribute(
                $attribute->name(),
                $attribute->value()
            );
        }

        if ($node->hasValue()) {
            $element->nodeValue = Utf8Sanitizer::sanitize(
                $node->value()
            );
        }

        foreach ($node->children() as $child) {
            $element->appendChild(
                $this->buildElement($child)
            );
        }

        return $element;
    }
}
