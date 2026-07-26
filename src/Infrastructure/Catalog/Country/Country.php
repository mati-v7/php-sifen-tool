<?php

namespace Nyxcode\PhpSifenTool\Infrastructure\Catalog\Country;

final readonly class Country
{
    public function __construct(
        private string $code,
        private string $name,
    ) {}

    public function code(): string
    {
        return $this->code;
    }

    public function name(): string
    {
        return $this->name;
    }
}
