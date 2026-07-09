<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

final readonly class EmailAddress
{
    public function __construct(
        private string $value,
    ) {
        # TODO: Implement email validations
    }

    public function value(): string
    {
        return $this->value;
    }
}
