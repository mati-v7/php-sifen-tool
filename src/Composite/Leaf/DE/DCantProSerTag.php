<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dCantProSer" tag in the XML structure.
 *
 * Cantidad del producto y/o servicio.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DCantProSerTag extends Tag
{
    public const TAG = "dCantProSer";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
