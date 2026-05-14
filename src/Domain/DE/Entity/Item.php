<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Entity;

final class Item
{
    public function __construct(
        private readonly string $description,
        private readonly float $quantity,
        private readonly float $unitPrice,
    ) {}

    public function description(): string
    {
        return $this->description;
    }

    public function quantity(): float
    {
        return $this->quantity;
    }

    public function unitPrice(): float
    {
        return $this->unitPrice;
    }

    public function total(): float
    {
        return $this->quantity * $this->unitPrice;
    }
}
