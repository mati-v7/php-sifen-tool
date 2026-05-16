<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Entity;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Money;

final class Totals
{
    public function __construct(
        private readonly Money $totalAmount,
        private readonly ?Money $taxableAmount10,
        private readonly ?Money $taxableAmount5,
        private readonly ?Money $vatAmount10,
        private readonly ?Money $vatAmount5,
    ) {}

    public function taxableAmount10(): ?Money
    {
        return $this->taxableAmount10;
    }

    public function taxableAmount5(): ?Money
    {
        return $this->taxableAmount5;
    }

    public function vatAmount10(): ?Money
    {
        return $this->vatAmount10;
    }

    public function vatAmount5(): ?Money
    {
        return $this->vatAmount5;
    }

    public function totalAmount(): Money
    {
        return $this->totalAmount;
    }
}
