<?php

namespace Nyxcode\PhpSifenTool\Composite\Concrete\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\TagComposite;

/**
 * Represents a "gCuotas" tag in the XML structure.
 *
 * Campos que describen las cuotas.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Concrete\DE
 */
class GCuotasTag extends TagComposite
{
    public const TAG = "gCuotas";

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
