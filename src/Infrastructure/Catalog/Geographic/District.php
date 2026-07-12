<?php

namespace Nyxcode\PhpSifenTool\Infrastructure\Catalog\Geographic;

final readonly class District
{
    public function __construct(
        public int $code,
        public string $name,
        public int $departmentCode,
    ) {}

    public function code(): int
    {
        return $this->code;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function departmentCode(): int
    {
        return $this->departmentCode;
    }
}
