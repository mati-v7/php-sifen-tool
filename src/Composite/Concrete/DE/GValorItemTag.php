<?php

namespace Nyxcode\PhpSifenTool\Composite\Concrete\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\TagComposite;

/**
 * Represents a "gValorItem" tag in the XML structure.
 *
 * Campos que describen los precios, descuentos y valor total por ítem.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Concrete\DE
 */
class GValorItemTag extends TagComposite
{
    public const TAG = "gValorItem";

    public function getName(): string
    {
        return self::TAG;
    }

    public function getValue()
    {
        return null;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        $element = parent::render($doc);
        return $doc->appendChild($element);
    }
}
