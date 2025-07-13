<?php

namespace Nyxcode\PhpSifenTool\Composite\Concrete\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\TagComposite;

/**
 * Represents a "gCamCond" tag in the XML structure.
 *
 * Campos que describen la condición de la operación.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Concrete\DE
 */
class GCamCondTag extends TagComposite
{
    public const TAG = "gCamCond";

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
