<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "iForProPa" tag in the XML structure.
 *
 * Forma de procesamiento de pago.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class IForProPaTag extends Tag
{
    public const TAG = "iForProPa";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
