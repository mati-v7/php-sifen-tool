<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dDncpE" tag in the XML structure.
 *
 * Código DNCP - Nivel Específico.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DDncpETag extends Tag
{
    public const TAG = "dDncpE";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
