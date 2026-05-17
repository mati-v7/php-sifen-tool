<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

final class CDC
{
    public function __construct(
        private readonly string $value,
    ) {}

    public function value(): string
    {
        return $this->value;
    }
}
