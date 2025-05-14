<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dTiCamTiPag" tag in the XML structure.
 *
 * Tipo de cambio por tipo de pago.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DTiCamTiPagTag extends Tag
{
    public const TAG = "dTiCamTiPag";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
