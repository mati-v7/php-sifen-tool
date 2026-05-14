<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

final class Percentage
{
    public function __construct(
        private readonly int $value,
    ) {
        if ($value < 0 || $value > 100) {
            throw new \InvalidArgumentException(
                'Percentage must be between 0 and 100.'
            );
        }
    }

    public function value(): int
    {
        return $this->value;
    }
}
