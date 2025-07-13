<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dDMoneTiPag" tag in the XML structure.
 *
 * Descripción de la moneda por tipo de pago.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DDMoneTiPagTag extends Tag
{
    public const TAG = "dDMoneTiPag";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
