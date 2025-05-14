<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dCuotas" tag in the XML structure.
 *
 * Cantidad de cuotas.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DCuotasTag extends Tag
{
    public const TAG = "dCuotas";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
