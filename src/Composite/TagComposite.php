<?php

namespace Nyxcode\PhpSifenTool\Composite;

use DOMDocument;
use DOMElement;

/**
 * Class TagComposite
 *
 * Represents a composite tag that can contain multiple child Tag objects.
 * Implements the composite design pattern, allowing hierarchical tag structures.
 *
 * @property array<Tag> $tags Collection of child Tag objects.
 */
class TagComposite extends Tag
{
    /**
     * @var array $tags
     * Stores the collection of tags associated with the composite.
     */
    protected $tags = [];

    /**
     * Adds a Tag object to the collection of tags.
     *
     * @param Tag $tag The tag instance to add.
     *
     * @return void
     */
    public function add(Tag $tag): void
    {
        $this->tags[] = $tag;
    }


    /**
     * Retrieves the list of tags associated with this composite.
     *
     * @return array The array of tags.
     */
    public function getTags(): array
    {
        return $this->tags;
    }


    /**
     * Retrieves a tag by its name.
     *
     * Iterates through the collection of tags and returns the first tag
     * whose name matches the provided name. If no matching tag is found,
     * null is returned.
     *
     * @param string $name The name of the tag to retrieve.
     * @return Tag|null The tag with the specified name, or null if not found.
     */
    public function getTag(string $name): ?Tag
    {
        foreach ($this->tags as $tag) {
            if ($tag->getName() === $name) {
                return $tag;
            }
        }

        return null;
    }

    /**
     * Removes the specified Tag object from the collection of tags.
     *
     * Iterates through the current tags and removes any tag that is equal to the provided Tag instance.
     *
     * @param Tag $tag The Tag instance to remove from the collection.
     *
     * @return void
     */
    public function remove(Tag $tag): void
    {
        $this->tags = array_filter($this->tags, function (Tag $childTag) use ($tag) {
            return !$childTag->equals($tag);
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
