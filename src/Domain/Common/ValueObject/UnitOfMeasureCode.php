<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

final readonly class UnitOfMeasureCode
{
    public function __construct(
        private int $value,
    ) {}

    public function value(): int
    {
        return $this->value;
    }
}
