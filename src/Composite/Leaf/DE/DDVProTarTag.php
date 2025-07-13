<?php

namespace Nyxcode\PhpSifenTool\Composite\Leaf\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Composite\Tag;

/**
 * Represents a "dDVProTar" tag in the XML structure.
 *
 * Dígito verificador del RUC de la procesadora de la tarjeta.
 *
 * @package Nyxcode\PhpSifenTool\Composite\Leaf\DE
 */
class DDVProTarTag extends Tag
{
    public const TAG = "dDVProTar";

    public function getName(): string
    {
        return self::TAG;
    }

    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
