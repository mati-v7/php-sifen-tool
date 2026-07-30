<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Entity;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Money;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\PaymentType;

final class CashPayment
{
    public function __construct(
        private readonly PaymentType $type,
        private readonly Money $amount,
        private readonly ?string $customDescription = null,
        private readonly ?string $exchangeRate = null,
    ) {}

    public function type(): PaymentType
    {
        return $this->type;
    }

    public function amount(): Money
    {
        return $this->amount;
    }

    public function customDescription(): ?string
    {
        return $this->customDescription;
    }

    public function description(): string
    {
        return $this->customDescription ?? $this->type->description();
    }

    public function exchangeRate(): ?string
    {
        return $this->exchangeRate;
    }
}
