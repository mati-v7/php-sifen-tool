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
}
