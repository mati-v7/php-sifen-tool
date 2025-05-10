<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dDCondOpe" tag in the XML structure.
 *
 * Descripción de la condición de la operación. (Contado o Crédito)
 * 
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DDCondOpeTag extends Tag
{
    public const TAG = "dDCondOpe";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
