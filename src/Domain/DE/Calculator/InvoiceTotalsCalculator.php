<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Calculator;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Money;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Invoice;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Item;

final class InvoiceTotalsCalculator
{
    public function calculate(Invoice $invoice): Money
    {
        return array_reduce(
            $invoice->items(),
            function (Money $carry, Item $item): Money {
                return $carry->add(
                    $item->total()
                );
            },
            Money::guaranies(0)
        );
    }
}
