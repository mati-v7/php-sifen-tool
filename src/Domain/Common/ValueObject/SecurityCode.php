<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

final class SecurityCode
{
    public function __construct(
        private readonly string $value,
    ) {
        if (! preg_match('/^\d{9}$/', $value)) {
            throw new \InvalidArgumentException(
                'Invalid security code.'
            );
        }
    }

    public static function generate(): self
    {
        $randomNumber = random_int(100000000, 999999999);

        return new self((string) $randomNumber);
    }

    public function value(): string
    {
        return $this->value;
    }
}
