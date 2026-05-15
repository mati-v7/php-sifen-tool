<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Entity;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Money;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Percentage;

final class Item
{
    public function __construct(
        private readonly string $description,
        private readonly float $quantity,
        private readonly Money $unitPrice,
        private readonly Percentage $vatPercentage,
    ) {}

    public function description(): string
    {
        return $this->description;
    }

    public function quantity(): float
    {
        return $this->quantity;
    }

    public function unitPrice(): Money
    {
        return $this->unitPrice;
    }

    public function vatPercentage(): Percentage
    {
        return $this->vatPercentage;
    }

    public function total(): Money
    {
        return $this->unitPrice->multiply($this->quantity);
    }
}
