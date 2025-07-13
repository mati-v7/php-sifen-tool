<?php

namespace Nyxcode\PhpSifenTool\Composite;

use DOMDocument;
use DOMElement;

abstract class Tag
{
    protected $name;
    protected $value;
    protected $attributes;

    public function __construct($value = null, array $attributes = [])
    {
        $this->value = $value;
        $this->attributes = $attributes;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function setValue($value): void
    {
        $this->value = $value;
    }
    public function getValue()
    {
        return $this->value;
    }
    abstract public function render(DOMDocument $doc): DOMElement;
}
