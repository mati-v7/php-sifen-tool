<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dDesProSer" tag in the XML structure.
 *
 * Descripción del producto y/o producto.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DDesProSerTag extends Tag
{
    public const TAG = "dDesProSer";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
