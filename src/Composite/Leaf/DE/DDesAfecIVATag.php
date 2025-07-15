<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dDesAfecIVA" tag in the XML structure.
 *
 * Descripción de la forma de afectación triburaria del IVA.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DDesAfecIVATag extends Tag
{
    public const TAG = "dDesAfecIVA";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
