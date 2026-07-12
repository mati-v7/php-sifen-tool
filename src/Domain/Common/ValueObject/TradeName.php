<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

final readonly class TradeName
{
    public function __construct(
        private string $value
    ) {
        // TODO: Implement TradeName validations
    }

    public function value(): string
    {
        return $this->value;
    }
}
