<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Tests\Unit\Domain\DE\Builder;

use Nyxcode\PhpSifenTool\Domain\Common\Collection\EconomicActivityCollection;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Address;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\BranchName;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\BusinessName;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\CityCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\DepartmentCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\DistrictCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\DocumentNumber;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\EconomicActivity;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\EmailAddress;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\EstablishmentCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ExpeditionPoint;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ItemVat;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Money;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Percentage;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\PhoneNumber;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Ruc;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\SecurityCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\TaxAuthorizationNumber;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\TradeName;
use Nyxcode\PhpSifenTool\Domain\DE\Builder\InvoiceBuilder;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\InvoiceData;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Issuer;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Item;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Operation;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\PaymentCondition;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Receiver;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\TaxAuthorization;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\ElectronicDocumentType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\EmissionType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\OperationConditionType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\PresenceIndicator;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\TaxpayerType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\TaxRegimeType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\VatTreatment;
use PHPUnit\Framework\TestCase;

final class InvoiceBuilderTest extends TestCase
{
    public function test_it_builds_an_invoice(): void
    {
        $operation = new Operation(EmissionType::NORMAL, SecurityCode::generate());

        $taxAuthorization = new TaxAuthorization(
            ElectronicDocumentType::ELECTRONIC_INVOICE,
            new TaxAuthorizationNumber('12345678'),
            new EstablishmentCode('001'),
            new ExpeditionPoint('001'),
            new DocumentNumber('1234567'),
            new \DateTimeImmutable
        );

        $issuer = new Issuer(
            ruc: new Ruc('1234567', 6),
            taxpayerType: TaxpayerType::LEGAL_ENTITY,
            name: new BusinessName('ACME Corp'),
            address: new Address(
                street: 'Main street',
                houseNumber: 123,
                department: new DepartmentCode(1, 'CAPITAL'),
                district: new DistrictCode(1, 'ASUNCION (DISTRITO)'),
                city: new CityCode(1, 'ASUNCION (DISTRITO)'),
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

        $receiver = new Receiver(
            documentNumber: '987654321',
            name: 'John Doe',
        );

        $paymentCondition = new PaymentCondition(OperationConditionType::CASH);
        $invoiceData = new InvoiceData(PresenceIndicator::IN_PERSON);

        $item1 = new Item(
            description: 'Product 1',
            quantity: 2,
            unitPrice: Money::guaranies('10.0'),
            vat: new ItemVat(
                tratment: VatTreatment::VAT_TAXABLE,
                rate: new Percentage(10),
                taxableProportion: new Percentage(100)
            )
        );

        $item2 = new Item(
            description: 'Product 2',
            quantity: 1,
            unitPrice: Money::guaranies('20.0'),
            vat: new ItemVat(
                tratment: VatTreatment::VAT_TAXABLE,
                rate: new Percentage(10),
                taxableProportion: new Percentage(100)
            )
        );

        $invoice = InvoiceBuilder::make(new \DateTimeImmutable)
            ->operation($operation)
            ->taxAuthorization($taxAuthorization)
            ->issuer($issuer)
            ->receiver($receiver)
            ->invoiceData($invoiceData)
            ->paymentCondition($paymentCondition)
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
