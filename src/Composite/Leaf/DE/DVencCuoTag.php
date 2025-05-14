<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dVencCuo" tag in the XML structure.
 *
 * Fecha de vencimiento de cada cuota.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Concrete\DE
 */
class DVencCuoTag extends Tag
{
    public const TAG = "dVencCuo";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
