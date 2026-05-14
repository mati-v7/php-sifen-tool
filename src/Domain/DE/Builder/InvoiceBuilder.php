<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Builder;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\Invoice;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Issuer;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Item;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Receiver;
use Nyxcode\PhpSifenTool\Domain\DE\Validator\InvoiceValidator;

final class InvoiceBuilder
{
    private ?Issuer $issuer = null;

    private ?Receiver $receiver = null;

    private InvoiceValidator $validator;

    /**
     * @var Item[]
     */
    private array $items = [];

    private function __construct()
    {
        $this->validator = new InvoiceValidator;
    }

    public static function make(): self
    {
        return new self;
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

    public function addItem(Item $item): self
    {
        $this->items[] = $item;

        return $this;
    }

    public function build(): Invoice
    {
        $invoice = new Invoice(
            issuer: $this->issuer,
            receiver: $this->receiver,
            items: $this->items,
            issuedAt: new \DateTimeImmutable,
        );

        $this->validator->validate($invoice);

        return $invoice;
    }
}
