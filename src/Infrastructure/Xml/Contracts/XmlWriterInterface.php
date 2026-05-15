<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts;

interface XmlWriterInterface
{
    public function startDocument(): void;

    public function createRoot(string $name): void;

    public function appendNode(
        string $parent,
        string $name,
        ?string $value = null,
    ): void;

    public function toString(): string;
}
