<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Tests\Unit\Domain\Calculator;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Money;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Percentage;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Ruc;
use Nyxcode\PhpSifenTool\Domain\DE\Builder\InvoiceBuilder;
use Nyxcode\PhpSifenTool\Domain\DE\Calculator\InvoiceTotalsCalculator;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Invoice;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Issuer;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Item;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Receiver;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class InvoiceTotalsCalculatorTest extends TestCase
{
    #[DataProvider('buildSampleInvoice')]
    public function test_calculate(Invoice $invoice): void
    {
        $calculator = new InvoiceTotalsCalculator;

        $total = $calculator->calculate($invoice);

        $this->assertSame('40', $total->amount());
    }

    public static function buildSampleInvoice(): array
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
            unitPrice: Money::guaranies('10.0'),
            vatPercentage: new Percentage(10)
        );

        $item2 = new Item(
            description: 'Product 2',
            quantity: 1,
            unitPrice: Money::guaranies('20.0'),
            vatPercentage: new Percentage(10)
        );

        $invoice = InvoiceBuilder::make()
            ->issuer($issuer)
            ->receiver($receiver)
            ->addItem($item1)
            ->addItem($item2)
            ->build();

        return [
            'invoice' => [$invoice],
        ];
    }
}
