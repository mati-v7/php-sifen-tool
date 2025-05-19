<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dCanQuiMer" tag in the XML structure.
 *
 * Cantidad de quiebra o merma.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DCanQuiMerTag extends Tag
{
    public const TAG = "dCanQuiMer";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
