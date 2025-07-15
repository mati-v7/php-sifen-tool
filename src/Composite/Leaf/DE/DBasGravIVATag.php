<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dBasGravIVA" tag in the XML structure.
 *
 * Base gravada del IVA por ítem
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DBasGravIVATag extends Tag
{
    public const TAG = "dBasGravIVA";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
