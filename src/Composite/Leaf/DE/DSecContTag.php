<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dSecCont" tag in the XML structure.
 * 
 * Secuencia - Código emitido por la DNCP
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DSecContTag extends Tag
{
    public const TAG = "dSecCont";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
