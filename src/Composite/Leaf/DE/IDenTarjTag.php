<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "iDenTarj" tag in the XML structure.
 *
 * Denominación de la tarjeta.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Concrete\DE
 */
class IDenTarjTag extends Tag
{
    public const TAG = "iDenTarj";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
