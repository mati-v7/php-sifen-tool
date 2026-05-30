<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Entity;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ItemVat;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Money;

final class Item
{
    public function __construct(
        private readonly string $description,
        private readonly float $quantity,
        private readonly Money $unitPrice,
        private readonly ItemVat $vat,
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

    public function vat(): ItemVat
    {
        return $this->vat;
    }

    public function total(): Money
    {
        return $this->unitPrice->multiply($this->quantity);
    }
}
