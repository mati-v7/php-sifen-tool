<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Tests\Unit\Domain\DE\Entity;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ContractingEntityCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ContractModalityCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ContractSequenceCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ContractYearCode;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\InvoiceData;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\PublicProcurement;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\PresenceIndicator;
use PHPUnit\Framework\TestCase;

final class InvoiceDataTest extends TestCase
{
    public function test_uses_catalog_description_for_known_presence_indicators(): void
    {
        $invoiceData = new InvoiceData(PresenceIndicator::IN_PERSON);

        $this->assertSame(PresenceIndicator::IN_PERSON, $invoiceData->presenceIndicator());
        $this->assertSame('Operación presencial', $invoiceData->presenceIndicatorDescription());
        $this->assertNull($invoiceData->futureDeliveryDate());
    }

    public function test_uses_custom_description_when_presence_indicator_is_other(): void
    {
        $invoiceData = new InvoiceData(
            PresenceIndicator::OTHER,
            'Operación no listada'
        );

        $this->assertSame('Operación no listada', $invoiceData->presenceIndicatorDescription());
    }

    public function test_requires_custom_description_when_presence_indicator_is_other(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new InvoiceData(PresenceIndicator::OTHER);
    }

    public function test_rejects_custom_description_outside_allowed_length(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new InvoiceData(PresenceIndicator::OTHER, 'Corta');
    }

    public function test_accepts_future_delivery_date(): void
    {
        $date = new \DateTimeImmutable('2026-08-15');

        $invoiceData = new InvoiceData(
            PresenceIndicator::IN_PERSON,
            null,
            $date
        );

        $this->assertSame($date, $invoiceData->futureDeliveryDate());
    }

    public function test_accepts_optional_public_procurement_data(): void
    {
        $this->assertNull($this->invoiceData()->publicProcurement());

        $publicProcurement = new PublicProcurement(
            new ContractModalityCode('LC'),
            new ContractingEntityCode('00001'),
            new ContractYearCode('26'),
            new ContractSequenceCode('1234567'),
            new \DateTimeImmutable('2026-07-01')
        );

        $invoiceData = new InvoiceData(
            PresenceIndicator::IN_PERSON,
            null,
            null,
            $publicProcurement
        );

        $this->assertSame($publicProcurement, $invoiceData->publicProcurement());
    }

    private function invoiceData(): InvoiceData
    {
        return new InvoiceData(PresenceIndicator::IN_PERSON);
    }
}
