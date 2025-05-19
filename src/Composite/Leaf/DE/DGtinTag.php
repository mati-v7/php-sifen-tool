<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dGtin" tag in the XML structure.
 *
 * Código GTIN por producto.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DGtinTag extends Tag
{
    public const TAG = "dGtin";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
