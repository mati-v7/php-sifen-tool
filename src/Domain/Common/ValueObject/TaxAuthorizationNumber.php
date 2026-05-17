<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

final class TaxAuthorizationNumber
{
    public function __construct(
        private readonly string $value,
    ) {
        if (! preg_match('/^\d{8}$/', $value)) {
            throw new \InvalidArgumentException(
                'Invalid timbrado number.'
            );
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
