<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dFeCodCont" tag in the XML structure.
 * 
 * Fecha de la emisión del código de contratación por la DNCP
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DFeCodContTag extends Tag
{
    public const TAG = "dFeCodCont";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
