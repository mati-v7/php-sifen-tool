<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dNumTarj" tag in the XML structure.
 *
 * Número de la tarjeta.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DNumTarjTag extends Tag
{
    public const TAG = "dNumTarj";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
