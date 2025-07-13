<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dPorcDesIt" tag in the XML structure.
 *
 * Porcentaje de descuento particular por ítem.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DPorcDesItTag extends Tag
{
    public const TAG = "dPorcDesIt";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
