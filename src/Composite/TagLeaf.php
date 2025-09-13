<?php

namespace Nyxcode\PhpSifenTool\Composite;

use DOMDocument;
use DOMElement;

/**
 * Class TagLeaf
 *
 * Represents a leaf node in a composite structure for XML tags.
 * Inherits from the Tag class and is responsible for rendering itself as a DOMElement.
 *
 */
class TagLeaf extends Tag
{
    public function render(DOMDocument $doc): DOMElement
    {
        return $doc->createElement($this->getName(), $this->getValue());
    }
}
