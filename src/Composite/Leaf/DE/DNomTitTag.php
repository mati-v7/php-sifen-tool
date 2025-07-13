<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dNomTit" tag in the XML structure.
 *
 * Nombre del titular de la tarjeta.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DNomTitTag extends Tag
{
    public const TAG = "dNomTit";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
