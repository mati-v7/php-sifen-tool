<?php

namespace Nyxcode\PhpSifenTool\Infrastructure\Catalog\Geographic;

final readonly class Department
{
    public function __construct(
        public int $code,
        public string $name,
    ) {}

    public function code(): int
    {
        return $this->code;
    }

    public function name(): string
    {
        return $this->name;
    }
}
