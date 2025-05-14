<?php

namespace Nyxcode\PhpSifenTool\Composite\Concrete\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\TagComposite;

/**
 * Represents a "gPagCheq" tag in the XML structure.
 *
 * Campos que describen la operación a crédito.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Concrete\DE
 */
class GPagCredTag extends TagComposite
{
    public const TAG = "gPagCred";

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
