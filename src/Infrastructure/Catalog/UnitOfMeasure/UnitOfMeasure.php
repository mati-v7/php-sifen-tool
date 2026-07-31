<?php

namespace Nyxcode\PhpSifenTool\Infrastructure\Catalog\UnitOfMeasure;

final class UnitOfMeasure
{
    public function __construct(
        private int $code,
        private string $representation,
        private string $description,
    ) {}

    public function code(): int
    {
        return $this->code;
    }

    public function representation(): string
    {
        return $this->representation;
    }

    public function description(): string
    {
        return $this->description;
    }
}
