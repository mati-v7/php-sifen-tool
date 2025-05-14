<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dRUCProTar" tag in the XML structure.
 *
 * RUC de la procesadora de tarjeta.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DRUCProTarTag extends Tag
{
    public const TAG = "dRUCProTar";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
