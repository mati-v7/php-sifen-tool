<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Entity;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Money;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\CreditConditionType;

final class CreditOperation
{
    /**
     * @param  Installment[]  $installments
     */
    public function __construct(
        private readonly CreditConditionType $conditionType,
        private readonly ?string $term = null,
        private readonly ?int $installmentsCount = null,
        private readonly ?Money $initialPayment = null,
        private readonly array $installments = [],
    ) {}

    public function conditionType(): CreditConditionType
    {
        return $this->conditionType;
    }

    public function term(): ?string
    {
        return $this->term;
    }

    public function installmentsCount(): ?int
    {
        return $this->installmentsCount;
    }

    public function initialPayment(): ?Money
    {
        return $this->initialPayment;
    }

    /**
     * @return Installment[]
     */
    public function installments(): array
    {
        return $this->installments;
    }
}
