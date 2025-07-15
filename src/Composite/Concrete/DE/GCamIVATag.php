<?php

namespace Nyxcode\PhpSifenTool\Composite\Concrete\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\TagComposite;

/**
 * Represents a "gCamIVA" tag in the XML structure.
 *
 * Campos que describen el IVA de la operación por ítem.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Concrete\DE
 */
class GCamIVATag extends TagComposite
{
    public const TAG = "gCamIVA";

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
