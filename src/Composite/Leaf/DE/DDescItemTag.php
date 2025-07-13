<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dDescItem" tag in the XML structure.
 *
 * Descuento particular sobre el precio unitario por ítem (impuestos incluidos).
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DDescItemTag extends Tag
{
    public const TAG = "dDescItem";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
