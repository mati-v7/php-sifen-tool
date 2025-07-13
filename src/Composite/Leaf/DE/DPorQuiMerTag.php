<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dPorQuiMer" tag in the XML structure.
 *
 * Porcentaje de quiebra o merma.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DPorQuiMerTag extends Tag
{
    public const TAG = "dPorQuiMer";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
