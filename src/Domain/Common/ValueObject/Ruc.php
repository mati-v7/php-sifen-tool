<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

use InvalidArgumentException;

final class Ruc
{
    public function __construct(
        private readonly string $value,
        private int $checkDigit,
    ) {
        if (! preg_match('/^\d{6,8}/', $value)) {
            throw new InvalidArgumentException('Invalid RUC format.');
        }

        if ($checkDigit < 0 || $checkDigit > 9) {
            throw new InvalidArgumentException(
                'Check Digit must be between 0 and 9.'
            );
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public function checkDigit(): int
    {
        return $this->checkDigit;
    }
}
