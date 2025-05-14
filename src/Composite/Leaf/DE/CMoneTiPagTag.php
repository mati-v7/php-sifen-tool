<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "cMoneTiPag" tag in the XML structure.
 *
 * Moneda por tipo de pago.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class CMoneTiPagTag extends Tag
{
    public const TAG = "cMoneTiPag";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
