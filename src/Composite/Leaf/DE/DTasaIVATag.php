<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dTasaIVA" tag in the XML structure.
 *
 * Tasa del IVA
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DTasaIVATag extends Tag
{
    public const TAG = "dTasaIVA";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
