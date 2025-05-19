<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dNCM" tag in the XML structure.
 *
 * Nomenclatura Común del Mercosur.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DNCMTag extends Tag
{
    public const TAG = "dNCM";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
