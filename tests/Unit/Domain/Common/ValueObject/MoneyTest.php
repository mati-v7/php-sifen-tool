<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Tests\Unit\Domain\Common\ValueObject;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Money;
use PHPUnit\Framework\TestCase;

final class MoneyTest extends TestCase
{
    public function test_from_amount(): void
    {
        $money = Money::fromAmount('100.00', 'USD');

        $this->assertSame('100', $money->amount());
    }

    public function test_add(): void
    {
        $money1 = Money::fromAmount('100.00', 'USD');
        $money2 = Money::fromAmount('50.00', 'USD');

        $result = $money1->add($money2);

        $this->assertSame('150', $result->amount());
    }

    public function test_multiply(): void
    {
        $money = Money::fromAmount('100.00', 'USD');

        $result = $money->multiply(2);

        $this->assertSame('200', $result->amount());
    }

    public function test_divide(): void
    {
        $money = Money::fromAmount('100.00', 'USD');

        $result = $money->divide(4);

        $this->assertSame('25', $result->amount());
    }

    /**
     * Examples from the SEDECO Resolución 347/2014 rounding table.
     */
    public function test_floor_to_nearest_rounds_down_to_the_multiple(): void
    {
        $this->assertSame('107400', Money::guaranies('107437')->floorToNearest(50)->amount());
        $this->assertSame('47750', Money::guaranies('47789')->floorToNearest(50)->amount());
    }

    public function test_floor_to_nearest_leaves_exact_multiples_untouched(): void
    {
        $this->assertSame('50000', Money::guaranies('50000')->floorToNearest(50)->amount());
    }
}
