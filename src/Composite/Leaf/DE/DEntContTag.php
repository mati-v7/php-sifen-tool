<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dEntCont" tag in the XML structure.
 * 
 * Entidad - Código emitido por la DNCP
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DEntContTag extends Tag
{
    public const TAG = "dEntCont";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
