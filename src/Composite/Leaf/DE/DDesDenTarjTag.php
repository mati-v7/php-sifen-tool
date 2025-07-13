<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dDesDenTarj" tag in the XML structure.
 *
 * Descripción de denominación de la tarjeta.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Concrete\DE
 */
class DDesDenTarjTag extends Tag
{
    public const TAG = "dDesDenTarj";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
