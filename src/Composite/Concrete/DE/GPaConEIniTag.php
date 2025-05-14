<?php

namespace Nyxcode\PhpSifenTool\Composite\Concrete\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\TagComposite;

/**
 * Represents a "gPaConEIni" tag in the XML structure.
 *
 * Campos que describen la forma de pago al contado o del monto de la entrega inicial.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Concrete\DE
 */
class GPaConEIniTag extends TagComposite
{
    public const TAG = "gPaConEIni";

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
