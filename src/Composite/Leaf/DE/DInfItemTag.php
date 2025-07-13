<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dInfItem" tag in the XML structure.
 *
 * Información de interés del emisor con respecto al ítem.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DInfItemTag extends Tag
{
    public const TAG = "dInfItem";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
