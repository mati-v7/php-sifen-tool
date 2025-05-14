<?php

namespace Nyxcode\PhpSifenTool\Composite\Concrete\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\TagComposite;

/**
 * Represents a "gPagCheq" tag in the XML structure.
 *
 * Campos que describen el pago o entrega inicial de la operación con cheque.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Concrete\DE
 */
class GPagCheqTag extends TagComposite
{
    public const TAG = "gPagCheq";

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
