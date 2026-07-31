<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Entity;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\CDC;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\CountryCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ItemVat;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Money;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\UnitOfMeasureCode;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\RelevantMerchandiseDataCode;

final class Item
{
    public function __construct(
        private readonly string $internalCode,
        private readonly string $description,
        private readonly float $quantity,
        private readonly UnitOfMeasureCode $unitOfMeasureCode,
        private readonly Money $unitPrice,
        private readonly ItemVat $vat,
        private readonly ?string $tariffPosition = null,
        private readonly ?string $ncm = null,
        private readonly ?string $dncpGeneralCode = null,
        private readonly ?string $dncpSpecificCode = null,
        private readonly ?string $gtin = null,
        private readonly ?string $gtinPackage = null,
        private readonly ?CountryCode $originCountry = null,
        private readonly ?string $additionalInfo = null,
        private readonly ?RelevantMerchandiseDataCode $relevantMerchandiseData = null,
        private readonly ?float $breakageOrShrinkageQuantity = null,
        private readonly ?float $breakageOrShrinkagePercentage = null,
        private readonly ?CDC $advancePaymentCDC = null,
        private readonly ?Money $discount = null,
        private readonly ?Money $globalDiscount = null,
        private readonly ?Money $advancePayment = null,
        private readonly ?Money $globalAdvancePayment = null,
        private readonly ?float $exchangeRate = null,
    ) {}

    public function internalCode(): string
    {
        return $this->internalCode;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function quantity(): float
    {
        return $this->quantity;
    }

    public function unitOfMeasureCode(): UnitOfMeasureCode
    {
        return $this->unitOfMeasureCode;
    }

    public function unitPrice(): Money
    {
        return $this->unitPrice;
    }

    public function vat(): ItemVat
    {
        return $this->vat;
    }

    public function tariffPosition(): ?string
    {
        return $this->tariffPosition;
    }

    public function ncm(): ?string
    {
        return $this->ncm;
    }

    public function dncpGeneralCode(): ?string
    {
        return $this->dncpGeneralCode;
    }

    public function dncpSpecificCode(): ?string
    {
        return $this->dncpSpecificCode;
    }

    public function gtin(): ?string
    {
        return $this->gtin;
    }

    public function gtinPackage(): ?string
    {
        return $this->gtinPackage;
    }

    public function originCountry(): ?CountryCode
    {
        return $this->originCountry;
    }

    public function additionalInfo(): ?string
    {
        return $this->additionalInfo;
    }

    public function relevantMerchandiseData(): ?RelevantMerchandiseDataCode
    {
        return $this->relevantMerchandiseData;
    }

    public function breakageOrShrinkageQuantity(): ?float
    {
        return $this->breakageOrShrinkageQuantity;
    }

    public function breakageOrShrinkagePercentage(): ?float
    {
        return $this->breakageOrShrinkagePercentage;
    }

    public function advancePaymentCDC(): ?CDC
    {
        return $this->advancePaymentCDC;
    }

    public function discount(): ?Money
    {
        return $this->discount;
    }

    public function globalDiscount(): ?Money
    {
        return $this->globalDiscount;
    }

    public function advancePayment(): ?Money
    {
        return $this->advancePayment;
    }

    public function globalAdvancePayment(): ?Money
    {
        return $this->globalAdvancePayment;
    }

    public function exchangeRate(): ?float
    {
        return $this->exchangeRate;
    }

    public function total(): Money
    {
        return $this->unitPrice->multiply($this->quantity);
    }
}
