<?php

namespace Nyxcode\PhpSifenTool\Infrastructure\Catalog\Geographic;

final readonly class City
{
    public function __construct(
        public int $code,
        public string $name,
        public int $districtCode,
    ) {}

    public function code(): int
    {
        return $this->code;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function districtCode(): int
    {
        return $this->districtCode;
    }
}
