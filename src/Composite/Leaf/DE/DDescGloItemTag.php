<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dDescGloItem" tag in the XML structure.
 *
 * Descuento global sobre el precio unitario por ítem (impuestos incluidos).
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DDescGloItemTag extends Tag
{
    public const TAG = "dDescGloItem";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
