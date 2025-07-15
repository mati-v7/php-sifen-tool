<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dPropIVA" tag in the XML structure.
 *
 * Proporción gravada de IVA
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DPropIVATag extends Tag
{
    public const TAG = "dPropIVA";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
