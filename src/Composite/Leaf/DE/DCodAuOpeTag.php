<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dCodAuOpe" tag in the XML structure.
 *
 * Código de autorización de la operación.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DCodAuOpeTag extends Tag
{
    public const TAG = "dCodAuOpe";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
