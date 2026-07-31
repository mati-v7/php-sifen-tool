<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Entity;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Money;

final class Totals
{
    public function __construct(
        private Money $exemptSubtotal,
        private Money $exoneratedSubtotal,
        private Money $taxableSubtotal5,
        private Money $taxableSubtotal10,
        private Money $totalOperation,
        private Money $totalDiscount,
        private Money $totalGlobalDiscountPerItem,
        private Money $totalAdvancePaymentPerItem,
        private Money $totalGlobalAdvancePaymentPerItem,
        private Money $totalDiscounts,
        private Money $totalAdvancePayments,
        private Money $rounding,
        private Money $totalGeneral,
        private Money $vat5,
        private Money $vat10,
        private ?Money $roundingVat5,
        private ?Money $roundingVat10,
        private Money $totalVat,
        private ?Money $taxableBase5,
        private ?Money $taxableBase10,
        private ?Money $totalTaxableBase,
    ) {}

    public function exemptSubtotal(): Money
    {
        return $this->exemptSubtotal;
    }

    public function exoneratedSubtotal(): Money
    {
        return $this->exoneratedSubtotal;
    }

    public function taxableSubtotal5(): Money
    {
        return $this->taxableSubtotal5;
    }

    public function taxableSubtotal10(): Money
    {
        return $this->taxableSubtotal10;
    }

    public function totalOperation(): Money
    {
        return $this->totalOperation;
    }

    public function totalDiscount(): Money
    {
        return $this->totalDiscount;
    }

    public function totalGlobalDiscountPerItem(): Money
    {
        return $this->totalGlobalDiscountPerItem;
    }

    public function totalAdvancePaymentPerItem(): Money
    {
        return $this->totalAdvancePaymentPerItem;
    }

    public function totalGlobalAdvancePaymentPerItem(): Money
    {
        return $this->totalGlobalAdvancePaymentPerItem;
    }

    public function totalDiscounts(): Money
    {
        return $this->totalDiscounts;
    }

    public function totalAdvancePayments(): Money
    {
        return $this->totalAdvancePayments;
    }

    public function rounding(): Money
    {
        return $this->rounding;
    }

    public function totalGeneral(): Money
    {
        return $this->totalGeneral;
    }

    public function vat5(): Money
    {
        return $this->vat5;
    }

    public function vat10(): Money
    {
        return $this->vat10;
    }

    public function roundingVat5(): ?Money
    {
        return $this->roundingVat5;
    }

    public function roundingVat10(): ?Money
    {
        return $this->roundingVat10;
    }

    public function totalVat(): Money
    {
        return $this->totalVat;
    }

    public function taxableBase5(): ?Money
    {
        return $this->taxableBase5;
    }

    public function taxableBase10(): ?Money
    {
        return $this->taxableBase10;
    }

    public function totalTaxableBase(): ?Money
    {
        return $this->totalTaxableBase;
    }
}
