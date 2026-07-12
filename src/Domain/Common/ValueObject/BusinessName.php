<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

final readonly class BusinessName
{
    public function __construct(
        private string $value
    ) {
        // TODO: Implement BusinessName validations
    }

    public function value(): string
    {
        return $this->value;
    }
}
