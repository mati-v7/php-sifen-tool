<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

final class ContractModalityCode
{
    public function __construct(
        private readonly string $value,
    ) {
        if (! preg_match('/^\w{2}$/', $value)) {
            throw new \InvalidArgumentException(
                'Invalid public procurement contract modality code.'
            );
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
