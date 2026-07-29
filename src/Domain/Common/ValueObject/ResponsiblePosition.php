<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

use InvalidArgumentException;

final readonly class ResponsiblePosition
{
    public function __construct(
        private string $value,
    ) {
        $length = mb_strlen($value);

        if ($length < 4 || $length > 100) {
            throw new InvalidArgumentException(
                'Responsible position must be between 4 and 100 characters.'
            );
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
