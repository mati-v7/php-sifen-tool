<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "cRelMerc" tag in the XML structure.
 *
 * Código de datos de relevancia de las mercaderías.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class CRelMercTag extends Tag
{
    public const TAG = "cRelMerc";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
