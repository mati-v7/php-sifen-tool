<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Support;

final class XmlCollection
{
    /**
     * @param  XmlElement[]  $elements
     */
    public function __construct(
        private readonly array $elements,
    ) {}

    /**
     * @return XmlElement[]
     */
    public function elements(): array
    {
        return $this->elements;
    }
}
