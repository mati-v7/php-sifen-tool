<?php

namespace Nyxcode\PhpSifenTool\Composite\Concrete\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\TagComposite;

/**
 * Represents a "gValorRestaItem" tag in the XML structure.
 *
 * Campos que describen descuentos, anticipos y valor total por ítem.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Concrete\DE
 */
class GValorRestaItemTag extends TagComposite
{
    public const TAG = "gValorRestaItem";

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
