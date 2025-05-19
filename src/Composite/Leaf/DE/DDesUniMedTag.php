<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dDesUniMed" tag in the XML structure.
 *
 * Descripción de la unidad de medida.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DDesUniMedTag extends Tag
{
    public const TAG = "dDesUniMed";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
