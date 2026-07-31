<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Tests\Unit\Domain\Calculator;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ItemVat;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Money;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Percentage;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\UnitOfMeasureCode;
use Nyxcode\PhpSifenTool\Domain\DE\Calculator\ItemPricingCalculator;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Item;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\VatTreatment;
use PHPUnit\Framework\TestCase;

final class ItemPricingCalculatorTest extends TestCase
{
    public function test_gross_total_is_unit_price_times_quantity(): void
    {
        $item = $this->item(quantity: 2, unitPrice: '100000');

        $calculator = new ItemPricingCalculator;

        $this->assertEquals(200000, $calculator->grossTotal($item)->amount());
    }

    public function test_discount_defaults_to_zero_when_not_informed(): void
    {
        $item = $this->item();

        $calculator = new ItemPricingCalculator;

        $this->assertTrue($calculator->discount($item)->isZero());
        $this->assertNull($calculator->discountPercentage($item));
    }

    public function test_discount_percentage_is_calculated_from_discount_and_unit_price(): void
    {
        $item = $this->item(unitPrice: '100000', discount: Money::guaranies('10000'));

        $calculator = new ItemPricingCalculator;

        $this->assertEquals('10.00000000', $calculator->discountPercentage($item));
    }

    public function test_net_total_without_discounts_or_advances_equals_gross_total(): void
    {
        $item = $this->item(quantity: 2, unitPrice: '100000');

        $calculator = new ItemPricingCalculator;

        $this->assertEquals(200000, $calculator->netTotal($item)->amount());
    }

    public function test_net_total_subtracts_discounts_and_advance_payments(): void
    {
        $item = $this->item(
            quantity: 2,
            unitPrice: '100000',
            discount: Money::guaranies('10000'),
            globalDiscount: Money::guaranies('5000'),
            advancePayment: Money::guaranies('2000'),
            globalAdvancePayment: Money::guaranies('1000'),
        );

        $calculator = new ItemPricingCalculator;

        // (100000 - 10000 - 5000 - 2000 - 1000) * 2 = 164000
        $this->assertEquals(164000, $calculator->netTotal($item)->amount());
    }

    public function test_net_total_ignores_discounts_for_self_billed_invoice(): void
    {
        $item = $this->item(
            quantity: 2,
            unitPrice: '100000',
            discount: Money::guaranies('10000'),
        );

        $calculator = new ItemPricingCalculator;

        $this->assertEquals(
            $calculator->grossTotal($item)->amount(),
            $calculator->netTotal($item, isSelfBilledInvoice: true)->amount()
        );
    }

    public function test_net_total_in_guaranies_is_null_without_exchange_rate(): void
    {
        $item = $this->item();

        $calculator = new ItemPricingCalculator;

        $this->assertNull($calculator->netTotalInGuaranies($item));
    }

    public function test_net_total_in_guaranies_multiplies_net_total_by_exchange_rate(): void
    {
        $item = $this->item(quantity: 2, unitPrice: '100000', exchangeRate: 7300.0);

        $calculator = new ItemPricingCalculator;

        // 200000 * 7300 = 1460000000
        $this->assertEquals(1460000000, $calculator->netTotalInGuaranies($item)->amount());
    }

    private function item(
        int $quantity = 1,
        string $unitPrice = '100000',
        ?Money $discount = null,
        ?Money $globalDiscount = null,
        ?Money $advancePayment = null,
        ?Money $globalAdvancePayment = null,
        ?float $exchangeRate = null,
    ): Item {
        return new Item(
            internalCode: 'INT-001',
            description: 'Product',
            quantity: $quantity,
            unitOfMeasureCode: new UnitOfMeasureCode(77),
            unitPrice: Money::guaranies($unitPrice),
            vat: new ItemVat(
                tratment: VatTreatment::VAT_TAXABLE,
                rate: new Percentage(10),
                taxableProportion: new Percentage(100)
            ),
            discount: $discount,
            globalDiscount: $globalDiscount,
            advancePayment: $advancePayment,
            globalAdvancePayment: $globalAdvancePayment,
            exchangeRate: $exchangeRate,
        );
    }
}
