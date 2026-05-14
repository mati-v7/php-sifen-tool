<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Entity;

final class Invoice
{
    /**
     * @param  Item[]  $items
     */
    public function __construct(
        private readonly Issuer $issuer,
        private readonly Receiver $receiver,
        private readonly array $items,
        private readonly \DateTimeImmutable $issuedAt,
    ) {}

    public function issuer(): Issuer
    {
        return $this->issuer;
    }

    public function receiver(): Receiver
    {
        return $this->receiver;
    }

    /**
     * @return Item[]
     */
    public function items(): array
    {
        return $this->items;
    }

    public function issuedAt(): \DateTimeImmutable
    {
        return $this->issuedAt;
    }

    public function total(): float
    {
        return array_reduce(
            $this->items,
            fn (float $carry, Item $item) => $carry + $item->total(),
            0
        );
    }
}
