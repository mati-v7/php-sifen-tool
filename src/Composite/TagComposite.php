<?php

namespace Nyxcode\PhpSifenTool\Composite;

use DOMDocument;
use DOMElement;

abstract class TagComposite extends Tag
{
    /**
     * @var array<Tag>
     */
    protected $tags = [];

    /**
     * @param Tag $tag
     * @return void
     */
    public function add(Tag $tag): void
    {
        $this->tags[] = $tag;
    }

    /**
     * @return array<Tag>
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param Tag $tag
     * @return void
     */
    public function remove(Tag $tag): void
    {
        $this->tags = array_filter($this->tags, function ($childTag) use ($tag) {
            return $childTag != $tag;
        });
    }

    public function render(DOMDocument $doc): DOMElement
    {
        $element = $doc->createElement($this->getName());
        foreach ($this->attributes as $key => $value) {
            $element->setAttribute($key, $value);
        }

        foreach ($this->tags as $name => $tag) {
            $childElement = $tag->render($doc);
            $element->appendChild($childElement);
        }

        return $element;
    }
}
