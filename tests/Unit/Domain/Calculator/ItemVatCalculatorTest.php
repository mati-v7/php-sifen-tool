<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Tests\Unit\Domain\Calculator;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ItemVat;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Money;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Percentage;
use Nyxcode\PhpSifenTool\Domain\DE\Calculator\ItemVatCalculator;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Item;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\VatTreatment;
use PHPUnit\Framework\TestCase;

final class ItemVatCalculatorTest extends TestCase
{
    public function test_calculates_taxable_base_for_10_percent_vat(): void
    {
        $item = new Item(
            internalCode: 'INT-001',
            description: 'Product',
            quantity: 1,
            unitOfMeasureCode: 77,
            unitOfMeasureDescription: 'UNI',
            unitPrice: Money::guaranies(110000),
            vat: new ItemVat(
                tratment: VatTreatment::VAT_TAXABLE,
                rate: new Percentage(10),
                taxableProportion: new Percentage(100)
            )
        );

        $calculator = new ItemVatCalculator;
        $base = $calculator->taxableBase($item);

        $this->assertEquals(100000, $base->amount());
    }

    public function test_calculates_taxable_base_for_5_percent_vat(): void
    {
        $item = new Item(
            internalCode: 'INT-001',
            description: 'Product',
            quantity: 1,
            unitOfMeasureCode: 77,
            unitOfMeasureDescription: 'UNI',
            unitPrice: Money::guaranies(105000),
            vat: new ItemVat(
                tratment: VatTreatment::VAT_TAXABLE,
                rate: new Percentage(5),
                taxableProportion: new Percentage(100)
            )
        );

        $calculator = new ItemVatCalculator;
        $base = $calculator->taxableBase($item);

        $this->assertEquals(100000, $base->amount());
    }

    public function test_returns_zero_for_exempt_item(): void
    {
        $item = new Item(
            internalCode: 'INT-001',
            description: 'Product',
            quantity: 1,
            unitOfMeasureCode: 77,
            unitOfMeasureDescription: 'UNI',
            unitPrice: Money::guaranies(105000),
            vat: new ItemVat(
                tratment: VatTreatment::VAT_EXEMPT,
                rate: new Percentage(0),
                taxableProportion: new Percentage(0)
            )
        );

        $calculator = new ItemVatCalculator;
        $base = $calculator->taxableBase($item);

        $this->assertEquals(0, $base->amount());
    }

    public function test_calculates_partial_taxable_proportion(): void
    {
        $item = new Item(
            internalCode: 'INT-001',
            description: 'Product',
            quantity: 1,
            unitOfMeasureCode: 77,
            unitOfMeasureDescription: 'UNI',
            unitPrice: Money::guaranies(100000),
            vat: new ItemVat(
                tratment: VatTreatment::VAT_PARTIALLY_TAXABLE,
                rate: new Percentage(10),
                taxableProportion: new Percentage(30)
            )
        );

        $calculator = new ItemVatCalculator;

        $base = $calculator->taxableBase($item);

        $this->assertEqualsWithDelta(
            '27273',
            $base->amount(),
            0.01
        );
    }

    public function test_calculates_vat_amount(): void
    {
        $item = new Item(
            internalCode: 'INT-001',
            description: 'Product',
            quantity: 1,
            unitOfMeasureCode: 77,
            unitOfMeasureDescription: 'UNI',
            unitPrice: Money::guaranies(110000),
            vat: new ItemVat(
                tratment: VatTreatment::VAT_TAXABLE,
                rate: new Percentage(10),
                taxableProportion: new Percentage(100)
            )
        );

        $calculator = new ItemVatCalculator;

        $vatAmount = $calculator->vatAmount($item);

        $this->assertEquals(10000, $vatAmount->amount());
    }
}
