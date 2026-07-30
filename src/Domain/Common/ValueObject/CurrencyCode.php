<?php

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

final readonly class CurrencyCode
{
    public function __construct(
        private string $value,
    ) {}

    public function value(): string
    {
        return strtoupper($this->value);
    }
}
