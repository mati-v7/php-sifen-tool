<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Tests\Unit\Domain\DE\Builder;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Ruc;
use Nyxcode\PhpSifenTool\Domain\DE\Builder\InvoiceBuilder;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Issuer;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Item;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Receiver;
use PHPUnit\Framework\TestCase;

final class InvoiceBuilderTest extends TestCase
{
    public function test_it_builds_an_invoice(): void
    {
        $issuer = new Issuer(
            ruc: new Ruc('1234567-9'),
            name: 'ACME Corp',
        );

        $receiver = new Receiver(
            documentNumber: '987654321',
            name: 'John Doe',
        );

        $item1 = new Item(
            description: 'Product 1',
            quantity: 2,
            unitPrice: 10.0,
        );

        $item2 = new Item(
            description: 'Product 2',
            quantity: 1,
            unitPrice: 20.0,
        );

        $invoice = InvoiceBuilder::make()
            ->issuer($issuer)
            ->receiver($receiver)
            ->addItem($item1)
            ->addItem($item2)
            ->build();

        $this->assertSame($issuer, $invoice->issuer());
        $this->assertSame($receiver, $invoice->receiver());
        $this->assertCount(2, $invoice->items());
        $this->assertSame($item1, $invoice->items()[0]);
        $this->assertSame($item2, $invoice->items()[1]);
    }
}
