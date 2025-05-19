<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dGtinPq" tag in the XML structure.
 *
 * Código GTIN por paquete.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DGtinPqTag extends Tag
{
    public const TAG = "dGtinPq";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
