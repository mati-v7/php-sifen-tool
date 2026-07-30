<?php

namespace Nyxcode\PhpSifenTool\Infrastructure\Catalog\Currency;

final class Currency
{
    public function __construct(
        private string $code,
        private string $description,
    ) {}

    public function code(): string
    {
        return $this->code;
    }

    public function description(): string
    {
        return $this->description;
    }
}
