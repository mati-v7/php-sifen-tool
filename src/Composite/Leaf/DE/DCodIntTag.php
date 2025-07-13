<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dCodInt" tag in the XML structure.
 *
 * Código interno.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DCodIntTag extends Tag
{
    public const TAG = "dCodInt";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
