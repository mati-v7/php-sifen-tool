<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dMonEnt" tag in the XML structure.
 *
 * Monto de la entrega inicial.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DMonEntTag extends Tag
{
    public const TAG = "dMonEnt";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
