<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Entity;

use Nyxcode\PhpSifenTool\Domain\DE\Calculator\InvoiceTotalsCalculator;
use Nyxcode\PhpSifenTool\Domain\DE\Calculator\ItemVatCalculator;

final class ElectronicDocument
{
    /**
     * @param  Item[]  $items
     */
    public function __construct(
        private readonly \DateTimeImmutable $issuedAt,
        private readonly Operation $operation,
        private readonly TaxAuthorization $timbrado,
        private readonly Issuer $issuer,
        private readonly Receiver $receiver,
        private readonly PaymentCondition $paymentCondition,
        private readonly InvoiceData $invoiceData,
        private readonly array $items,
    ) {}

    public function issuedAt(): \DateTimeImmutable
    {
        return $this->issuedAt;
    }

    public function operation(): Operation
    {
        return $this->operation;
    }

    public function taxAuthorization(): TaxAuthorization
    {
        return $this->timbrado;
    }

    public function issuer(): Issuer
    {
        return $this->issuer;
    }

    public function receiver(): Receiver
    {
        return $this->receiver;
    }

    public function paymentCondition(): PaymentCondition
    {
        return $this->paymentCondition;
    }

    public function invoiceData(): InvoiceData
    {
        return $this->invoiceData;
    }

    /**
     * @return Item[]
     */
    public function items(): array
    {
        return $this->items;
    }

    public function totals(): Totals
    {
        $calculator = new InvoiceTotalsCalculator(new ItemVatCalculator);

        return $calculator->calculate($this);
    }
}
