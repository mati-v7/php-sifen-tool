<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Calculator;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Money;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\ElectronicDocument;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Item;

final class InvoiceTotalsCalculator
{
    private function calculate(ElectronicDocument $document, string $method): Money
    {
        return array_reduce(
            $document->items(),
            function (Money $carry, Item $item) use ($method): Money {
                return $carry->add(
                    $item->{$method}()
                );
            },
            Money::guaranies(0)
        );
    }

    public function calculateTaxableAmount10(ElectronicDocument $invoice): Money
    {
        return $this->calculate($invoice, 'taxableAmount10');
    }

    public function calculateTaxableAmount5(ElectronicDocument $invoice): Money
    {
        return $this->calculate($invoice, 'taxableAmount5');
    }

    public function calculateVatAmount10(ElectronicDocument $invoice): Money
    {
        return $this->calculate($invoice, 'vatAmount5');
    }

    public function calculateVatAmount5(ElectronicDocument $invoice): Money
    {
        return $this->calculate($invoice, 'vatAmount5');
    }

    public function calculateTotalAmount(ElectronicDocument $invoice): Money
    {
        return $this->calculate($invoice, 'total');
    }
}
