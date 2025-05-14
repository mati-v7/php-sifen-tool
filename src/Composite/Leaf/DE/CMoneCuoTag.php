<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "cMoneCuo" tag in the XML structure.
 *
 * Moneda de las cuotas.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Concrete\DE
 */
class CMoneCuoTag extends Tag
{
    public const TAG = "cMoneCuo";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
