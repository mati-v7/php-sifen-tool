<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dPlazoCre" tag in the XML structure.
 *
 * Plazo de crédito.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DPlazoCreTag extends Tag
{
    public const TAG = "dPlazoCre";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
