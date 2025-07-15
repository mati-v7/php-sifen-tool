<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dLiqIVAItem" tag in the XML structure.
 *
 * Liquidación del IVA por ítem
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DLiqIVAItemTag extends Tag
{
    public const TAG = "dLiqIVAItem";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
