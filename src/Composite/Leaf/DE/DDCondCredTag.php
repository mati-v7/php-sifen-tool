<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dDCondCred" tag in the XML structure.
 *
 * Descripción de la condición de la operación a crédito.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DDCondCredTag extends Tag
{
    public const TAG = "dDCondCred";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
