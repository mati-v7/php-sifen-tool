<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dDncpG" tag in the XML structure.
 *
 * Código DNCP - Nivel General.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DDncpGTag extends Tag
{
    public const TAG = "dDncpG";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
