<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dTiCamIt" tag in the XML structure.
 *
 * Tipo de cambio por ítem.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DTiCamItTag extends Tag
{
    public const TAG = "dTiCamIt";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
