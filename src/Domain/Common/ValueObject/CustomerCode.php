<?php

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

final class CustomerCode
{
    public function __construct(
        private string $value,
    ) {}

    public function value(): string
    {
        return $this->value;
    }
}
