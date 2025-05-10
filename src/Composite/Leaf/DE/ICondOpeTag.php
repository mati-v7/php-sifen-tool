<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "iCondOpe" tag in the XML structure.
 * 
 * Condición de la Operación. (Contado o Crédito)
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class ICondOpeTag extends Tag
{
    public const TAG = "iCondOpe";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
