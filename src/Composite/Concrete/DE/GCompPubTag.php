<?php

namespace Nyxcode\PhpSifenTool\Composite\Concrete\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\TagComposite;

/**
 * Represents a "gCompPub" tag in the XML structure.
 *
 * Campos que describen las informaciones de compras públicas
 *
 * @package Nyxcode\PhpSifenTool\Composite\Concrete\DE
 */
class GCompPubTag extends TagComposite
{
    public const TAG = "gCompPub";

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
