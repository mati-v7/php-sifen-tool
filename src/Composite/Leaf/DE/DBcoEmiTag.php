<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dBcoEmi" tag in the XML structure.
 *
 * Banco emisor.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DBcoEmiTag extends Tag
{
    public const TAG = "dBcoEmi";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
