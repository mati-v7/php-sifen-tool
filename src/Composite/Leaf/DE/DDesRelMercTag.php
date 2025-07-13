<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dDesRelMerc" tag in the XML structure.
 *
 * Descripción del código de datos de relevancia de las mercaderías.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DDesRelMercTag extends Tag
{
    public const TAG = "dDesRelMerc";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
