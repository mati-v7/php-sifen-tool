<?php

namespace Nyxcode\PhpSifenTool\Composite;

use BackedEnum;
use DOMDocument;
use DOMElement;

/**
 * Abstract base class representing a generic XML tag with a name, value, and optional attributes.
 *
 * This class provides common functionality for handling tag names, values, and attributes,
 * and enforces the implementation of a render method for converting the tag into a DOMElement.
 *
 * @property string $name        The name of the tag, derived from a BackedEnum value.
 * @property mixed  $value       The value/content of the tag.
 * @property array  $attributes  An associative array of attributes for the tag.
 *
 * @method string getName()      Retrieves the name of the tag.
 * @method void setValue(mixed $value) Sets the value of the tag.
 * @method mixed getValue()      Retrieves the value of the tag.
 * @method DOMElement render(DOMDocument $doc) Abstract method to render the tag as a DOMElement.
 *
 */
abstract class Tag
{
    protected string $name;
    protected mixed $value;
    protected array $attributes;

    public function __construct(BackedEnum $name, mixed $value = null, array $attributes = [])
    {
        $this->name = $name->value;
        $this->value = $value;
        $this->attributes = $attributes;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function setValue(mixed $value): void
    {
        $this->value = $value;
    }
    public function getValue(): mixed
    {
        return $this->value;
    }
    /**
     * Renders the current tag as a DOMElement within the provided DOMDocument.
     *
     * @param DOMDocument $doc The DOMDocument instance to which the element will be appended.
     * @return DOMElement The rendered DOMElement representing this tag.
     */
    abstract public function render(DOMDocument $doc): DOMElement;
}
