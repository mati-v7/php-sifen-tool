<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dNumCheq" tag in the XML structure.
 *
 * Número de cheque.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DNumCheqTag extends Tag
{
    public const TAG = "dNumCheq";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
