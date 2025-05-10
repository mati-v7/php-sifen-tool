<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dAnoCont" tag in the XML structure.
 * 
 * Año - Código emitido por la DNCP
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DAnoContTag extends Tag
{
    public const TAG = "dAnoCont";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
