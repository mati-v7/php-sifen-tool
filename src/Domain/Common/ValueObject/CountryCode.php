<?php

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

final class CountryCode
{
    public function __construct(
        private string $code
    ) {}

    public function value(): string
    {
        return $this->code;
    }
}
