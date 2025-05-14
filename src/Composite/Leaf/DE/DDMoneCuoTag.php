<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dDMoneCuo" tag in the XML structure.
 *
 * Descripción de la moneda de las cuotas.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Concrete\DE
 */
class DDMoneCuoTag extends Tag
{
    public const TAG = "dDMoneCuo";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
