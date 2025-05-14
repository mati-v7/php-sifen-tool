<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dMonTiPag" tag in the XML structure.
 *
 * Monto por Tipo de Pago.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DMonTiPagTag extends Tag
{
    public const TAG = "dMonTiPag";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
