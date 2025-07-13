<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dTotOpeItem" tag in the XML structure.
 *
 * Valor total de la operación por ítem.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DTotOpeItemTag extends Tag
{
    public const TAG = "dTotOpeItem";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
