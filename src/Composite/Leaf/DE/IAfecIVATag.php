<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "iAfecIVA" tag in the XML structure.
 *
 * Forma de afectación tributaria del IVA
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class IAfecIVATag extends Tag
{
    public const TAG = "iAfecIVA";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
