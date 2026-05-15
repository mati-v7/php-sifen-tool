<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Tests\Unit\Domain\Calculator;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Money;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Percentage;
use Nyxcode\PhpSifenTool\Domain\DE\Calculator\VatCalculator;
use PHPUnit\Framework\TestCase;

final class VatCalculatorTest extends TestCase
{
    public function test_calculate_vat(): void
    {
        $calculator = new VatCalculator;

        $amount = Money::guaranies('100.00');
        $vatRate = new Percentage(10);

        $vat = $calculator->calculateVat($amount, $vatRate);

        $this->assertSame('9', $vat->amount());
    }
}
