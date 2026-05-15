<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Tests\Unit\Domain\DE\Validator;

use Nyxcode\PhpSifenTool\Domain\Common\Exception\ValidationException;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Money;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Percentage;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Ruc;
use Nyxcode\PhpSifenTool\Domain\DE\Builder\InvoiceBuilder;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Issuer;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Item;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Receiver;
use Nyxcode\PhpSifenTool\Domain\DE\Validator\InvoiceValidator;
use PHPUnit\Framework\TestCase;

final class InvoiceValidatorTest extends TestCase
{
    public function test_expect_invoice_contains_at_least_one_item(): void
    {
        $this->expectException(ValidationException::class);

        $invoice = InvoiceBuilder::make()
            ->issuer(new Issuer(
                ruc: new Ruc('1234567-9'),
                name: 'ACME Corp',
            ))
            ->receiver(new Receiver(
                documentNumber: '987654321',
                name: 'John Doe',
            ))
            ->build();

        // Validate the invoice (this should throw an exception)
        $validator = new InvoiceValidator;
        $validator->validate($invoice);
    }

    public function test_expect_quantity_greater_than_zero(): void
    {
        $this->expectException(ValidationException::class);

        $invoice = InvoiceBuilder::make()
            ->issuer(new Issuer(
                ruc: new Ruc('1234567-9'),
                name: 'ACME Corp',
            ))
            ->receiver(new Receiver(
                documentNumber: '987654321',
                name: 'John Doe',
            ))
            ->addItem(
                new Item(
                    description: 'Product 1',
                    quantity: 0,
                    unitPrice: Money::guaranies('10.0'),
                    vatPercentage: new Percentage(10)
                )
            )
            ->build();

        // Validate the invoice (this should throw an exception)
        $validator = new InvoiceValidator;
        $validator->validate($invoice);
    }

    public function test_expect_price_cannot_be_negative(): void
    {
        $this->expectException(ValidationException::class);

        $invoice = InvoiceBuilder::make()
            ->issuer(new Issuer(
                ruc: new Ruc('1234567-9'),
                name: 'ACME Corp',
            ))
            ->receiver(new Receiver(
                documentNumber: '987654321',
                name: 'John Doe',
            ))
            ->addItem(
                new Item(
                    description: 'Product 1',
                    quantity: 1,
                    unitPrice: Money::guaranies('-10.0'),
                    vatPercentage: new Percentage(10)
                )
            )
            ->build();

        // Validate the invoice (this should throw an exception)
        $validator = new InvoiceValidator;
        $validator->validate($invoice);
    }
}
