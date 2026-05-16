<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

final class DocumentNumber
{
    public function __construct(
        private readonly string $value,
    ) {
        if (! preg_match('/^\d{7}$/', $value)) {
            throw new \InvalidArgumentException(
                'Invalid document number.'
            );
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
