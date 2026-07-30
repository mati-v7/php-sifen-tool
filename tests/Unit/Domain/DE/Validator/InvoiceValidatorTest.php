<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Tests\Unit\Domain\DE\Validator;

use Nyxcode\PhpSifenTool\Domain\Common\Collection\EconomicActivityCollection;
use Nyxcode\PhpSifenTool\Domain\Common\Exception\ValidationException;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Address;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\BranchName;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\BusinessName;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\CityCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ContractingEntityCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ContractModalityCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ContractSequenceCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ContractYearCode;
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
use Nyxcode\PhpSifenTool\Domain\DE\Entity\CardPayment;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\CashPayment;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\ChequePayment;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\CreditOperation;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\EconomicActivity;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Installment;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\InvoiceData;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Issuer;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Item;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Operation;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\PaymentCondition;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\PublicProcurement;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Receiver;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\TaxAuthorization;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\CardBrand;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\CardPaymentProcessingType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\CreditConditionType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\ElectronicDocumentType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\EmissionType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\IdentityDocumentType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\OperationConditionType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\OperationType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\PaymentType;
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

    public function test_expect_public_procurement_data_required_when_receiver_operation_is_b2g(): void
    {
        $this->expectException(ValidationException::class);

        $invoice = InvoiceBuilder::make(new \DateTimeImmutable)
            ->operation($this->operation())
            ->taxAuthorization($this->taxAuth())
            ->issuer($this->issuer())
            ->receiver($this->receiver(OperationType::B2G))
            ->paymentCondition($this->paymentCondition())
            ->invoiceData($this->invoiceData())
            ->addItem($this->item())
            ->build();

        $validator = new InvoiceValidator;
        $validator->validate($invoice);
    }

    public function test_expect_public_procurement_code_issued_before_invoice_issue_date(): void
    {
        $this->expectException(ValidationException::class);

        $issuedAt = new \DateTimeImmutable('2026-07-01');

        $invoice = InvoiceBuilder::make($issuedAt)
            ->operation($this->operation())
            ->taxAuthorization($this->taxAuth())
            ->issuer($this->issuer())
            ->receiver($this->receiver(OperationType::B2G))
            ->paymentCondition($this->paymentCondition())
            ->invoiceData($this->invoiceData($this->publicProcurement($issuedAt)))
            ->addItem($this->item())
            ->build();

        $validator = new InvoiceValidator;
        $validator->validate($invoice);
    }

    public function test_accepts_valid_public_procurement_data_for_b2g_operation(): void
    {
        $issuedAt = new \DateTimeImmutable('2026-07-30');
        $codeIssuedAt = new \DateTimeImmutable('2026-07-01');

        $invoice = InvoiceBuilder::make($issuedAt)
            ->operation($this->operation())
            ->taxAuthorization($this->taxAuth())
            ->issuer($this->issuer())
            ->receiver($this->receiver(OperationType::B2G))
            ->paymentCondition($this->paymentCondition())
            ->invoiceData($this->invoiceData($this->publicProcurement($codeIssuedAt)))
            ->addItem($this->item())
            ->build();

        $validator = new InvoiceValidator;
        $validator->validate($invoice);

        $this->assertNotNull($invoice->invoiceData()->publicProcurement());
    }

    public function test_expect_cash_payment_required_when_condition_is_cash(): void
    {
        $this->expectException(ValidationException::class);

        $invoice = InvoiceBuilder::make(new \DateTimeImmutable)
            ->operation($this->operation())
            ->taxAuthorization($this->taxAuth())
            ->issuer($this->issuer())
            ->receiver($this->receiver())
            ->paymentCondition(new PaymentCondition(OperationConditionType::CASH))
            ->invoiceData($this->invoiceData())
            ->addItem($this->item())
            ->build();

        $validator = new InvoiceValidator;
        $validator->validate($invoice);
    }

    public function test_expect_custom_description_required_when_payment_type_is_other(): void
    {
        $this->expectException(ValidationException::class);

        $invoice = InvoiceBuilder::make(new \DateTimeImmutable)
            ->operation($this->operation())
            ->taxAuthorization($this->taxAuth())
            ->issuer($this->issuer())
            ->receiver($this->receiver())
            ->paymentCondition(new PaymentCondition(
                OperationConditionType::CASH,
                [new CashPayment(PaymentType::OTHER, Money::guaranies('100'))]
            ))
            ->invoiceData($this->invoiceData())
            ->addItem($this->item())
            ->build();

        $validator = new InvoiceValidator;
        $validator->validate($invoice);
    }

    public function test_expect_exchange_rate_required_when_currency_is_not_pyg(): void
    {
        $this->expectException(ValidationException::class);

        $invoice = InvoiceBuilder::make(new \DateTimeImmutable)
            ->operation($this->operation())
            ->taxAuthorization($this->taxAuth())
            ->issuer($this->issuer())
            ->receiver($this->receiver())
            ->paymentCondition(new PaymentCondition(
                OperationConditionType::CASH,
                [new CashPayment(PaymentType::CASH, Money::fromAmount('100', 'USD'))]
            ))
            ->invoiceData($this->invoiceData())
            ->addItem($this->item())
            ->build();

        $validator = new InvoiceValidator;
        $validator->validate($invoice);
    }

    public function test_expect_card_payment_required_when_payment_type_is_credit_card(): void
    {
        $this->expectException(ValidationException::class);

        $invoice = InvoiceBuilder::make(new \DateTimeImmutable)
            ->operation($this->operation())
            ->taxAuthorization($this->taxAuth())
            ->issuer($this->issuer())
            ->receiver($this->receiver())
            ->paymentCondition(new PaymentCondition(
                OperationConditionType::CASH,
                [new CashPayment(PaymentType::CREDIT_CARD, Money::guaranies('100'))]
            ))
            ->invoiceData($this->invoiceData())
            ->addItem($this->item())
            ->build();

        $validator = new InvoiceValidator;
        $validator->validate($invoice);
    }

    public function test_expect_card_payment_not_allowed_when_payment_type_is_not_card(): void
    {
        $this->expectException(ValidationException::class);

        $invoice = InvoiceBuilder::make(new \DateTimeImmutable)
            ->operation($this->operation())
            ->taxAuthorization($this->taxAuth())
            ->issuer($this->issuer())
            ->receiver($this->receiver())
            ->paymentCondition(new PaymentCondition(
                OperationConditionType::CASH,
                [
                    new CashPayment(
                        type: PaymentType::CASH,
                        amount: Money::guaranies('100'),
                        cardPayment: new CardPayment(
                            brand: CardBrand::VISA,
                            processingType: CardPaymentProcessingType::POS,
                        ),
                    ),
                ]
            ))
            ->invoiceData($this->invoiceData())
            ->addItem($this->item())
            ->build();

        $validator = new InvoiceValidator;
        $validator->validate($invoice);
    }

    public function test_expect_custom_card_brand_description_required_when_brand_is_other(): void
    {
        $this->expectException(ValidationException::class);

        $invoice = InvoiceBuilder::make(new \DateTimeImmutable)
            ->operation($this->operation())
            ->taxAuthorization($this->taxAuth())
            ->issuer($this->issuer())
            ->receiver($this->receiver())
            ->paymentCondition(new PaymentCondition(
                OperationConditionType::CASH,
                [
                    new CashPayment(
                        type: PaymentType::CREDIT_CARD,
                        amount: Money::guaranies('100'),
                        cardPayment: new CardPayment(
                            brand: CardBrand::OTHER,
                            processingType: CardPaymentProcessingType::POS,
                        ),
                    ),
                ]
            ))
            ->invoiceData($this->invoiceData())
            ->addItem($this->item())
            ->build();

        $validator = new InvoiceValidator;
        $validator->validate($invoice);
    }

    public function test_accepts_valid_card_payment(): void
    {
        $invoice = InvoiceBuilder::make(new \DateTimeImmutable)
            ->operation($this->operation())
            ->taxAuthorization($this->taxAuth())
            ->issuer($this->issuer())
            ->receiver($this->receiver())
            ->paymentCondition(new PaymentCondition(
                OperationConditionType::CASH,
                [
                    new CashPayment(
                        type: PaymentType::CREDIT_CARD,
                        amount: Money::guaranies('100'),
                        cardPayment: new CardPayment(
                            brand: CardBrand::VISA,
                            processingType: CardPaymentProcessingType::POS,
                        ),
                    ),
                ]
            ))
            ->invoiceData($this->invoiceData())
            ->addItem($this->item())
            ->build();

        $validator = new InvoiceValidator;
        $validator->validate($invoice);

        $this->assertNotNull(
            $invoice->paymentCondition()->cashPayments()[0]->cardPayment()
        );
    }

    public function test_expect_cheque_payment_required_when_payment_type_is_cheque(): void
    {
        $this->expectException(ValidationException::class);

        $invoice = InvoiceBuilder::make(new \DateTimeImmutable)
            ->operation($this->operation())
            ->taxAuthorization($this->taxAuth())
            ->issuer($this->issuer())
            ->receiver($this->receiver())
            ->paymentCondition(new PaymentCondition(
                OperationConditionType::CASH,
                [new CashPayment(PaymentType::CHECK, Money::guaranies('100'))]
            ))
            ->invoiceData($this->invoiceData())
            ->addItem($this->item())
            ->build();

        $validator = new InvoiceValidator;
        $validator->validate($invoice);
    }

    public function test_expect_cheque_payment_not_allowed_when_payment_type_is_not_cheque(): void
    {
        $this->expectException(ValidationException::class);

        $invoice = InvoiceBuilder::make(new \DateTimeImmutable)
            ->operation($this->operation())
            ->taxAuthorization($this->taxAuth())
            ->issuer($this->issuer())
            ->receiver($this->receiver())
            ->paymentCondition(new PaymentCondition(
                OperationConditionType::CASH,
                [
                    new CashPayment(
                        type: PaymentType::CASH,
                        amount: Money::guaranies('100'),
                        chequePayment: new ChequePayment(
                            number: '1234',
                            issuingBank: 'Banco S.A.',
                        ),
                    ),
                ]
            ))
            ->invoiceData($this->invoiceData())
            ->addItem($this->item())
            ->build();

        $validator = new InvoiceValidator;
        $validator->validate($invoice);
    }

    public function test_accepts_valid_cheque_payment(): void
    {
        $invoice = InvoiceBuilder::make(new \DateTimeImmutable)
            ->operation($this->operation())
            ->taxAuthorization($this->taxAuth())
            ->issuer($this->issuer())
            ->receiver($this->receiver())
            ->paymentCondition(new PaymentCondition(
                OperationConditionType::CASH,
                [
                    new CashPayment(
                        type: PaymentType::CHECK,
                        amount: Money::guaranies('100'),
                        chequePayment: new ChequePayment(
                            number: '1234',
                            issuingBank: 'Banco S.A.',
                        ),
                    ),
                ]
            ))
            ->invoiceData($this->invoiceData())
            ->addItem($this->item())
            ->build();

        $validator = new InvoiceValidator;
        $validator->validate($invoice);

        $this->assertNotNull(
            $invoice->paymentCondition()->cashPayments()[0]->chequePayment()
        );
    }

    public function test_expect_credit_operation_required_when_condition_is_credit(): void
    {
        $this->expectException(ValidationException::class);

        $invoice = InvoiceBuilder::make(new \DateTimeImmutable)
            ->operation($this->operation())
            ->taxAuthorization($this->taxAuth())
            ->issuer($this->issuer())
            ->receiver($this->receiver())
            ->paymentCondition(new PaymentCondition(OperationConditionType::CREDIT))
            ->invoiceData($this->invoiceData())
            ->addItem($this->item())
            ->build();

        $validator = new InvoiceValidator;
        $validator->validate($invoice);
    }

    public function test_expect_credit_operation_not_allowed_when_condition_is_not_credit(): void
    {
        $this->expectException(ValidationException::class);

        $invoice = InvoiceBuilder::make(new \DateTimeImmutable)
            ->operation($this->operation())
            ->taxAuthorization($this->taxAuth())
            ->issuer($this->issuer())
            ->receiver($this->receiver())
            ->paymentCondition(new PaymentCondition(
                OperationConditionType::CASH,
                [new CashPayment(PaymentType::CASH, Money::guaranies('100'))],
                new CreditOperation(CreditConditionType::TERM, term: '30 días'),
            ))
            ->invoiceData($this->invoiceData())
            ->addItem($this->item())
            ->build();

        $validator = new InvoiceValidator;
        $validator->validate($invoice);
    }

    public function test_expect_term_required_when_credit_condition_is_term(): void
    {
        $this->expectException(ValidationException::class);

        $invoice = InvoiceBuilder::make(new \DateTimeImmutable)
            ->operation($this->operation())
            ->taxAuthorization($this->taxAuth())
            ->issuer($this->issuer())
            ->receiver($this->receiver())
            ->paymentCondition(new PaymentCondition(
                OperationConditionType::CREDIT,
                [],
                new CreditOperation(CreditConditionType::TERM),
            ))
            ->invoiceData($this->invoiceData())
            ->addItem($this->item())
            ->build();

        $validator = new InvoiceValidator;
        $validator->validate($invoice);
    }

    public function test_expect_installments_count_required_when_credit_condition_is_installment(): void
    {
        $this->expectException(ValidationException::class);

        $invoice = InvoiceBuilder::make(new \DateTimeImmutable)
            ->operation($this->operation())
            ->taxAuthorization($this->taxAuth())
            ->issuer($this->issuer())
            ->receiver($this->receiver())
            ->paymentCondition(new PaymentCondition(
                OperationConditionType::CREDIT,
                [],
                new CreditOperation(CreditConditionType::INSTALLMENT),
            ))
            ->invoiceData($this->invoiceData())
            ->addItem($this->item())
            ->build();

        $validator = new InvoiceValidator;
        $validator->validate($invoice);
    }

    public function test_expect_installments_not_allowed_when_credit_condition_is_not_installment(): void
    {
        $this->expectException(ValidationException::class);

        $invoice = InvoiceBuilder::make(new \DateTimeImmutable)
            ->operation($this->operation())
            ->taxAuthorization($this->taxAuth())
            ->issuer($this->issuer())
            ->receiver($this->receiver())
            ->paymentCondition(new PaymentCondition(
                OperationConditionType::CREDIT,
                [],
                new CreditOperation(
                    conditionType: CreditConditionType::TERM,
                    term: '30 días',
                    installments: [new Installment(Money::guaranies('100'))],
                ),
            ))
            ->invoiceData($this->invoiceData())
            ->addItem($this->item())
            ->build();

        $validator = new InvoiceValidator;
        $validator->validate($invoice);
    }

    public function test_accepts_valid_credit_operation_with_term(): void
    {
        $invoice = InvoiceBuilder::make(new \DateTimeImmutable)
            ->operation($this->operation())
            ->taxAuthorization($this->taxAuth())
            ->issuer($this->issuer())
            ->receiver($this->receiver())
            ->paymentCondition(new PaymentCondition(
                OperationConditionType::CREDIT,
                [],
                new CreditOperation(CreditConditionType::TERM, term: '30 días'),
            ))
            ->invoiceData($this->invoiceData())
            ->addItem($this->item())
            ->build();

        $validator = new InvoiceValidator;
        $validator->validate($invoice);

        $this->assertNotNull($invoice->paymentCondition()->creditOperation());
    }

    public function test_accepts_valid_credit_operation_with_installments(): void
    {
        $invoice = InvoiceBuilder::make(new \DateTimeImmutable)
            ->operation($this->operation())
            ->taxAuthorization($this->taxAuth())
            ->issuer($this->issuer())
            ->receiver($this->receiver())
            ->paymentCondition(new PaymentCondition(
                OperationConditionType::CREDIT,
                [],
                new CreditOperation(
                    conditionType: CreditConditionType::INSTALLMENT,
                    installmentsCount: 2,
                    installments: [
                        new Installment(Money::guaranies('50')),
                        new Installment(Money::guaranies('50')),
                    ],
                ),
            ))
            ->invoiceData($this->invoiceData())
            ->addItem($this->item())
            ->build();

        $validator = new InvoiceValidator;
        $validator->validate($invoice);

        $this->assertCount(
            2,
            $invoice->paymentCondition()->creditOperation()->installments()
        );
    }

    private function publicProcurement(\DateTimeImmutable $codeIssuedAt): PublicProcurement
    {
        return new PublicProcurement(
            new ContractModalityCode('LC'),
            new ContractingEntityCode('00001'),
            new ContractYearCode('26'),
            new ContractSequenceCode('1234567'),
            $codeIssuedAt
        );
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

    private function receiver(OperationType $operation = OperationType::B2C): Receiver
    {
        return new Receiver(
            nature: ReceiverNature::NON_TAXPAYER,
            operation: $operation,
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
        return new PaymentCondition(
            OperationConditionType::CASH,
            [
                new CashPayment(PaymentType::CASH, Money::guaranies('100')),
            ]
        );
    }

    private function invoiceData(?PublicProcurement $publicProcurement = null): InvoiceData
    {
        return new InvoiceData(PresenceIndicator::IN_PERSON, null, null, $publicProcurement);
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
