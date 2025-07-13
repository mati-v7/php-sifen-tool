<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dAntGloPreUniIt" tag in the XML structure.
 *
 * Anticipo global sobre el precio unitario por ítem (impuestos incluidos).
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DAntGloPreUniItTag extends Tag
{
    public const TAG = "dAntGloPreUniIt";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
