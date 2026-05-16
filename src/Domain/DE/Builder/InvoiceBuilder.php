<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Builder;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\ElectronicDocument;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\InvoiceData;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Issuer;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Item;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Operation;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\PaymentCondition;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Receiver;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\TaxAuthorization;
use Nyxcode\PhpSifenTool\Domain\DE\Validator\InvoiceValidator;

final class InvoiceBuilder
{
    private ?Operation $operation = null;

    private ?TaxAuthorization $taxAuthorization = null;

    private ?Issuer $issuer = null;

    private ?Receiver $receiver = null;

    private ?PaymentCondition $paymentCondition = null;

    private ?InvoiceData $invoiceData = null;

    private InvoiceValidator $validator;

    /**
     * @var Item[]
     */
    private array $items = [];

    private function __construct(
        private \DateTimeImmutable $issuedAt
    ) {
        $this->validator = new InvoiceValidator;
    }

    public static function make(\DateTimeImmutable $issuedAt): self
    {
        return new self($issuedAt);
    }

    public function operation(Operation $operation): self
    {
        $this->operation = $operation;

        return $this;
    }

    public function taxAuthorization(TaxAuthorization $taxAuthorization): self
    {
        $this->taxAuthorization = $taxAuthorization;

        return $this;
    }

    public function issuer(Issuer $issuer): self
    {
        $this->issuer = $issuer;

        return $this;
    }

    public function receiver(Receiver $receiver): self
    {
        $this->receiver = $receiver;

        return $this;
    }

    public function paymentCondition(PaymentCondition $paymentCondition): self
    {
        $this->paymentCondition = $paymentCondition;

        return $this;
    }

    public function invoiceData(InvoiceData $invoiceData): self
    {
        $this->invoiceData = $invoiceData;

        return $this;
    }

    public function addItem(Item $item): self
    {
        $this->items[] = $item;

        return $this;
    }

    public function build(): ElectronicDocument
    {
        $invoice = new ElectronicDocument(
            issuedAt: $this->issuedAt,
            operation: $this->operation,
            timbrado: $this->taxAuthorization,
            issuer: $this->issuer,
            receiver: $this->receiver,
            paymentCondition: $this->paymentCondition,
            invoiceData: $this->invoiceData,
            items: $this->items
        );

        $this->validator->validate($invoice);

        return $invoice;
    }
}
