<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "iCondCred" tag in the XML structure.
 *
 * Condición de la operación a crédito.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class ICondCredTag extends Tag
{
    public const TAG = "iCondCred";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
