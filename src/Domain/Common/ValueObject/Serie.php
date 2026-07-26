<?php

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

final class Serie
{
    public function __construct(
        private readonly string $value,
    ) {
        if (! preg_match('/^\w{2}$/', $value)) {
            throw new \InvalidArgumentException(
                'Invalid document number serie.'
            );
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
