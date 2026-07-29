<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

use InvalidArgumentException;

final readonly class ResponsibleName
{
    public function __construct(
        private string $value,
    ) {
        $length = mb_strlen($value);

        if ($length < 4 || $length > 255) {
            throw new InvalidArgumentException(
                'Responsible name must be between 4 and 255 characters.'
            );
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
