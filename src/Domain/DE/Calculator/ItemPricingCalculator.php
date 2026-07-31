<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Calculator;

use Brick\Math\BigDecimal;
use Brick\Math\RoundingMode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Money;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Item;

final class ItemPricingCalculator
{
    public function grossTotal(Item $item): Money
    {
        return $item->total();
    }

    public function discount(Item $item): Money
    {
        return $item->discount() ?? Money::zero($item->unitPrice()->currency());
    }

    public function globalDiscount(Item $item): Money
    {
        return $item->globalDiscount() ?? Money::zero($item->unitPrice()->currency());
    }

    public function advancePayment(Item $item): Money
    {
        return $item->advancePayment() ?? Money::zero($item->unitPrice()->currency());
    }

    public function globalAdvancePayment(Item $item): Money
    {
        return $item->globalAdvancePayment() ?? Money::zero($item->unitPrice()->currency());
    }

    public function discountPercentage(Item $item): ?string
    {
        $discount = $this->discount($item);

        if ($discount->isZero()) {
            return null;
        }

        return BigDecimal::of($discount->amount())
            ->multipliedBy('100')
            ->dividedBy($item->unitPrice()->amount(), 8, RoundingMode::HALF_UP)
            ->toString();
    }

    public function netUnitPrice(Item $item): Money
    {
        return $item->unitPrice()
            ->subtract($this->discount($item))
            ->subtract($this->globalDiscount($item))
            ->subtract($this->advancePayment($item))
            ->subtract($this->globalAdvancePayment($item));
    }

    public function netTotal(Item $item, bool $isSelfBilledInvoice = false): Money
    {
        if ($isSelfBilledInvoice) {
            return $this->grossTotal($item);
        }

        return $this->netUnitPrice($item)->multiply($item->quantity());
    }

    public function netTotalInGuaranies(Item $item, bool $isSelfBilledInvoice = false): ?Money
    {
        if ($item->exchangeRate() === null) {
            return null;
        }

        return $this->netTotal($item, $isSelfBilledInvoice)
            ->multiply((string) $item->exchangeRate());
    }
}
