<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dTotBruOpeItem" tag in the XML structure.
 *
 * Total bruto de la operación por ítem.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DTotBruOpeItemTag extends Tag
{
    public const TAG = "dTotBruOpeItem";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
