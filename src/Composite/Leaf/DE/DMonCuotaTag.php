<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dMonCuota" tag in the XML structure.
 *
 * Monto de cada cuota.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Concrete\DE
 */
class DMonCuotaTag extends Tag
{
    public const TAG = "dMonCuota";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
