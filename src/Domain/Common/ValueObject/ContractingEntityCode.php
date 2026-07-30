<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

final class ContractingEntityCode
{
    public function __construct(
        private readonly string $value,
    ) {
        if (! preg_match('/^\d{5}$/', $value)) {
            throw new \InvalidArgumentException(
                'Invalid public procurement contracting entity code.'
            );
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
