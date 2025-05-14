<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dRSProTar" tag in the XML structure.
 *
 * Razón social de la procesadora de tarjeta.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DRSProTarTag extends Tag
{
    public const TAG = "dRSProTar";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
