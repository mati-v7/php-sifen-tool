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
        private Money $vat5,
        private Money $vat10,
        private Money $totalVat,
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

    public function vat5(): Money
    {
        return $this->vat5;
    }

    public function vat10(): Money
    {
        return $this->vat10;
    }

    public function totalVat(): Money
    {
        return $this->totalVat;
    }

    public function totalOperation(): Money
    {
        return $this->totalOperation;
    }
}
