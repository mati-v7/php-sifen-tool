<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Support;

final class XmlElement
{
    /**
     * @var XmlElement[]
     */
    private array $children = [];

    /**
     * @var XmlAttribute[]
     */
    private array $attributes = [];

    public function __construct(
        private readonly string $name,
        private readonly ?string $value = null,
    ) {}

    public static function make(
        string $name,
        ?string $value = null,
    ): self {
        return new self($name, $value);
    }

    public function addChild(XmlElement $element): self
    {
        $this->children[] = $element;

        return $this;
    }

    public function addAttribute(
        string $name,
        string $value,
    ): self {
        $this->attributes[] = new XmlAttribute(
            $name,
            $value
        );

        return $this;
    }

    /**
     * @param  XmlElement[]  $elements
     */
    public function addChildren(array $elements): self
    {
        foreach ($elements as $element) {
            $this->addChild($element);
        }

        return $this;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function value(): ?string
    {
        return $this->value;
    }

    /**
     * @return XmlElement[]
     */
    public function children(): array
    {
        return $this->children;
    }

    /**
     * @return XmlAttribute[]
     */
    public function attributes(): array
    {
        return $this->attributes;
    }

    public function hasValue(): bool
    {
        return $this->value !== null
            && trim($this->value) !== '';
    }

    public function hasChildren(): bool
    {
        return count($this->children) > 0;
    }
}
