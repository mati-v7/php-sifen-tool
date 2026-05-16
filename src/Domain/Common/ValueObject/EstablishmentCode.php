<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

final class EstablishmentCode
{
    public function __construct(
        private readonly string $value
    ) {
        if (! preg_match('/^\d{3}$/', $value)) {
            throw new \InvalidArgumentException(
                'Invalid establishment code.'
            );
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
