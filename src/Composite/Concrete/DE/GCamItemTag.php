<?php

namespace Nyxcode\PhpSifenTool\Composite\Concrete\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\TagComposite;

/**
 * Represents a "gCamItem" tag in the XML structure.
 *
 * Campos que describen los items de la operación.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Concrete\DE
 */
class GCamItemTag extends TagComposite
{
    public const TAG = "gCamItem";

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
