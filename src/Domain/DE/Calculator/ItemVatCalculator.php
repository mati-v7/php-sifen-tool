<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Calculator;

use Brick\Math\BigDecimal;
use DomainException;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Money;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Item;

final class ItemVatCalculator
{
    public function taxableBase(Item $item): Money
    {
        $vat = $item->vat();

        if ($vat->isExempt()) {
            return Money::fromAmount('0', 'PYG');
        }

        $taxableProportion = $vat->taxableProportion()->value();
        $total = $item->total();

        $taxableAmount = $total->multiply(
            BigDecimal::of($taxableProportion)->dividedBy('100', 8)->toString()
        );

        $divisor = match ($vat->rate()->value()) {
            10 => '1.1',
            5 => '1.05',
            default => throw new DomainException(
                'Unsupported VAT rate.'
            )
        };

        return Money::fromAmount(
            $taxableAmount->divide($divisor)->amount(),
            'PYG'
        );
    }

    public function vatAmount(Item $item): Money
    {
        $base = $this->taxableBase($item);
        $rate = $item->vat()->rate()->value();

        return Money::fromAmount(
            $base->multiply(
                BigDecimal::of($rate)->dividedBy('100', 8)->toString()
            )->amount(),
            'PYG'
        );
    }
}
