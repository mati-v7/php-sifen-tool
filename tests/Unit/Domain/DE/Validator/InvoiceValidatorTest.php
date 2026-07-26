<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Tests\Unit\Domain\DE\Validator;

use Nyxcode\PhpSifenTool\Domain\Common\Collection\EconomicActivityCollection;
use Nyxcode\PhpSifenTool\Domain\Common\Exception\ValidationException;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Address;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\BranchName;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\BusinessName;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\CityCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\CountryCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\DocumentNumber;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\EmailAddress;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\EstablishmentCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ExpeditionPoint;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\IdentityDocument;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ItemVat;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Money;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Percentage;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\PhoneNumber;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Ruc;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\SecurityCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\TaxAuthorizationNumber;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\TradeName;
use Nyxcode\PhpSifenTool\Domain\DE\Builder\InvoiceBuilder;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\EconomicActivity;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\InvoiceData;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Issuer;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Item;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Operation;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\PaymentCondition;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Receiver;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\TaxAuthorization;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\ElectronicDocumentType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\EmissionType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\IdentityDocumentType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\OperationConditionType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\OperationType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\PresenceIndicator;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\ReceiverNature;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\TaxpayerType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\TaxRegimeType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\VatTreatment;
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
        return new Operation(
            EmissionType::NORMAL,
            SecurityCode::generate(),
            null,
            null
        );
    }

    private function taxAuth(): TaxAuthorization
    {
        return new TaxAuthorization(
            ElectronicDocumentType::ELECTRONIC_INVOICE,
            new TaxAuthorizationNumber('12345678'),
            new EstablishmentCode('001'),
            new ExpeditionPoint('001'),
            new DocumentNumber('1234567'),
            new \DateTimeImmutable,
            null
        );
    }

    private function issuer(): Issuer
    {
        return new Issuer(
            ruc: new Ruc('1234567', 6),
            taxpayerType: TaxpayerType::LEGAL_ENTITY,
            name: new BusinessName('ACME Corp'),
            address: new Address(
                street: 'Main street',
                houseNumber: 123,
                city: new CityCode(1),
                complement1: 'Alternative street 1',
                complement2: 'Alternative street 2',
            ),
            phoneNumber: new PhoneNumber('(+595 21) 000 000'),
            emailAddress: new EmailAddress('info@email.com'),
            activities: new EconomicActivityCollection(
                new EconomicActivity('0000', 'ECONOMIC ACTIVITY')
            ),
            taxRegimeType: TaxRegimeType::SMALL_PRODUCER_REGIME,
            branchName: new BranchName('ACME Main store'),
            tradeName: new TradeName('ACME store')
        );
    }

    private function receiver(): Receiver
    {
        return new Receiver(
            nature: ReceiverNature::NON_TAXPAYER,
            operation: OperationType::B2C,
            countryCode: new CountryCode('PRY'),
            document: new IdentityDocument(IdentityDocumentType::NATIONAL_ID, '987654321'),
            legalName: 'John Doe',
            fantasyName: null,
            address: null,
            phone: null,
            cellphone: null,
            email: null,
            customerCode: null
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
            vat: new ItemVat(
                tratment: VatTreatment::VAT_TAXABLE,
                rate: new Percentage(10),
                taxableProportion: new Percentage(100)
            )
        );
    }
}
