<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dModCont" tag in the XML structure.
 * 
 * Modalidad - Código emitido por la DNCP
 * 
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DModContTag extends Tag
{
    public const TAG = "dModCont";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
