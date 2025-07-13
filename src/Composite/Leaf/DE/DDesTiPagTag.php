<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dDesTiPag" tag in the XML structure.
 *
 * Descripción del Tipo de Pago.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DDesTiPagTag extends Tag
{
    public const TAG = "dDesTiPag";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
