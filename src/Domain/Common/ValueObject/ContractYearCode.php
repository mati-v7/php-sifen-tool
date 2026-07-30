<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

final class ContractYearCode
{
    public function __construct(
        private readonly string $value,
    ) {
        if (! preg_match('/^\d{2}$/', $value)) {
            throw new \InvalidArgumentException(
                'Invalid public procurement contract year code.'
            );
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
