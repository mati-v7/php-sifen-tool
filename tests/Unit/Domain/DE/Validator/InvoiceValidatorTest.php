<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Tests\Unit\Domain\DE\Validator;

use Nyxcode\PhpSifenTool\Domain\Common\Exception\ValidationException;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\DocumentNumber;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\EstablishmentCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ExpeditionPoint;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Money;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Percentage;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Ruc;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\SecurityCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\TaxAuthorizationNumber;
use Nyxcode\PhpSifenTool\Domain\DE\Builder\InvoiceBuilder;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\InvoiceData;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Issuer;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Item;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Operation;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\PaymentCondition;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Receiver;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\TaxAuthorization;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\EmissionType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\OperationConditionType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\PresenceIndicator;
use Nyxcode\PhpSifenTool\Domain\DE\Validator\InvoiceValidator;
use PHPUnit\Framework\TestCase;

final class InvoiceValidatorTest extends TestCase
{
    public function test_expect_invoice_contains_at_least_one_item(): void
    {
        $this->expectException(ValidationException::class);

        $invoice = InvoiceBuilder::make(new \DateTimeImmutable)
            ->operation($this->operation())
            ->taxAuthorization($this->taxAuth())
            ->issuer($this->issuer())
            ->receiver($this->receiver())
            ->paymentCondition($this->paymentCondition())
            ->invoiceData($this->invoiceData())
            ->build();

        // Validate the invoice (this should throw an exception)
        $validator = new InvoiceValidator;
        $validator->validate($invoice);
    }

    public function test_expect_quantity_greater_than_zero(): void
    {
        $this->expectException(ValidationException::class);

        $invoice = InvoiceBuilder::make(new \DateTimeImmutable)
            ->operation($this->operation())
            ->taxAuthorization($this->taxAuth())
            ->issuer($this->issuer())
            ->receiver($this->receiver())
            ->paymentCondition($this->paymentCondition())
            ->invoiceData($this->invoiceData())
            ->addItem($this->item(0, 10))
            ->build();

        // Validate the invoice (this should throw an exception)
        $validator = new InvoiceValidator;
        $validator->validate($invoice);
    }

    public function test_expect_price_cannot_be_negative(): void
    {
        $this->expectException(ValidationException::class);

        $invoice = InvoiceBuilder::make(new \DateTimeImmutable)
            ->operation($this->operation())
            ->taxAuthorization($this->taxAuth())
            ->issuer($this->issuer())
            ->receiver($this->receiver())
            ->paymentCondition($this->paymentCondition())
            ->invoiceData($this->invoiceData())
            ->addItem($this->item(1, -10))
            ->build();

        // Validate the invoice (this should throw an exception)
        $validator = new InvoiceValidator;
        $validator->validate($invoice);
    }

    private function operation(): Operation
    {
        return new Operation(EmissionType::NORMAL, SecurityCode::generate());
    }

    private function taxAuth(): TaxAuthorization
    {
        return new TaxAuthorization(
            new TaxAuthorizationNumber('12345678'),
            new EstablishmentCode('001'),
            new ExpeditionPoint('001'),
            new DocumentNumber('1234567')
        );
    }

    private function issuer(): Issuer
    {
        return new Issuer(
            ruc: new Ruc('1234567-9'),
            name: 'ACME Corp',
        );
    }

    private function receiver(): Receiver
    {
        return new Receiver(
            documentNumber: '987654321',
            name: 'John Doe',
        );
    }

    private function paymentCondition(): PaymentCondition
    {
        return new PaymentCondition(OperationConditionType::CASH);
    }

    private function invoiceData(): InvoiceData
    {
        return new InvoiceData(PresenceIndicator::IN_PERSON);
    }

    private function item(int $quantity = 1, float $unitPrice = 10): Item
    {
        return new Item(
            description: 'Product',
            quantity: $quantity,
            unitPrice: Money::guaranies((string) $unitPrice),
            vatPercentage: new Percentage(10)
        );
    }
}
