<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

use Brick\Math\BigInteger;
use Brick\Math\RoundingMode;
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

    public static function zero(string $currency): self
    {
        return new self(
            new BaseMoney(
                '0',
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

    public function subtract(self $money): self
    {
        return new self(
            $this->value->subtract($money->value)
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

    public function isZero(): bool
    {
        return $this->value->isZero();
    }

    /**
     * Floors the amount down to the nearest multiple, per the rounding
     * rule of Resolución 347/2014 (SEDECO) for multiples of 50 guaraníes.
     */
    public function floorToNearest(int $multiple): self
    {
        $floored = BigInteger::of($this->value->getAmount())
            ->dividedBy($multiple, RoundingMode::FLOOR)
            ->multipliedBy($multiple);

        return new self(
            new BaseMoney((string) $floored, $this->value->getCurrency())
        );
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
