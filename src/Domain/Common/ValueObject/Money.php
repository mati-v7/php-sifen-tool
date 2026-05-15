<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

use Money\Currency;
use Money\Money as BaseMoney;

final class Money
{
    private BaseMoney $value;

    private function __construct(BaseMoney $value)
    {
        $this->value = $value;
    }

    public static function guaranies(int|string $amount): self
    {
        return new self(
            new BaseMoney(
                (string) $amount,
                new Currency('PYG')
            )
        );
    }

    public static function fromAmount(string $amount, string $currency): self
    {
        return new self(
            new BaseMoney(
                $amount,
                new Currency($currency)
            )
        );
    }

    public function add(self $money): self
    {
        return new self(
            $this->value->add($money->value)
        );
    }

    public function multiply(float|int|string $multiplier): self
    {
        return new self(
            $this->value->multiply((string) $multiplier)
        );
    }

    public function divide(float|int|string $divisor): self
    {
        return new self(
            $this->value->divide((string) $divisor)
        );
    }

    public function amount(): string
    {
        return $this->value->getAmount();
    }

    public function equals(self $money): bool
    {
        return $this->value->equals($money->value);
    }

    public function greaterThan(self $money): bool
    {
        return $this->value->greaterThan($money->value);
    }

    public function isNegative(): bool
    {
        return $this->value->isNegative();
    }

    public function currency(): string
    {
        return $this->value->getCurrency()->getCode();
    }

    public function raw(): BaseMoney
    {
        return $this->value;
    }
}
