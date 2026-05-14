<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Entity;

final class Receiver
{
    public function __construct(
        private readonly string $documentNumber,
        private readonly string $name,
    ) {}

    public function documentNumber(): string
    {
        return $this->documentNumber;
    }

    public function name(): string
    {
        return $this->name;
    }
}
