<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

use InvalidArgumentException;

final class Ruc
{
    public function __construct(
        private readonly string $value,
    ) {
        if (! preg_match('/^\d{6,8}-\d$/', $value)) {
            throw new InvalidArgumentException('Invalid RUC format.');
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
