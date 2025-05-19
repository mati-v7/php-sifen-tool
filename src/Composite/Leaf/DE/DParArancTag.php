<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dParAranc" tag in the XML structure.
 *
 * Partida arancelaria.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DParArancTag extends Tag
{
    public const TAG = "dParAranc";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
