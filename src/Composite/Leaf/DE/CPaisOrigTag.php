<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "cPaisOrig" tag in the XML structure.
 *
 * Código del país de origen del producto.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class CPaisOrigTag extends Tag
{
    public const TAG = "cPaisOrig";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
