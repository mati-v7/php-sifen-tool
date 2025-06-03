<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dPUniProSer" tag in the XML structure.
 *
 * Precio unitario del producto y/o servicio (incluidos impuestos).
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DPUniProSerTag extends Tag
{
    public const TAG = "dPUniProSer";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
