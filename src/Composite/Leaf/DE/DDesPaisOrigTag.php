<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dDesPaisOrig" tag in the XML structure.
 *
 * Descripción del país de origen del producto.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DDesPaisOrigTag extends Tag
{
    public const TAG = "dDesPaisOrig";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
