<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dCDCAnticipo" tag in the XML structure.
 *
 * CDC del anticipo.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DCDCAnticipoTag extends Tag
{
    public const TAG = "dCDCAnticipo";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
