<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Entity;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Ruc;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\CardBrand;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\CardPaymentProcessingType;

final class CardPayment
{
    public function __construct(
        private readonly CardBrand $brand,
        private readonly CardPaymentProcessingType $processingType,
        private readonly ?string $customBrandDescription = null,
        private readonly ?string $processorBusinessName = null,
        private readonly ?Ruc $processorRuc = null,
        private readonly ?string $authorizationCode = null,
        private readonly ?string $holderName = null,
        private readonly ?string $cardNumber = null,
    ) {}

    public function brand(): CardBrand
    {
        return $this->brand;
    }

    public function processingType(): CardPaymentProcessingType
    {
        return $this->processingType;
    }

    public function customBrandDescription(): ?string
    {
        return $this->customBrandDescription;
    }

    public function brandDescription(): string
    {
        return $this->customBrandDescription ?? $this->brand->description();
    }

    public function processorBusinessName(): ?string
    {
        return $this->processorBusinessName;
    }

    public function processorRuc(): ?Ruc
    {
        return $this->processorRuc;
    }

    public function authorizationCode(): ?string
    {
        return $this->authorizationCode;
    }

    public function holderName(): ?string
    {
        return $this->holderName;
    }

    public function cardNumber(): ?string
    {
        return $this->cardNumber;
    }
}
