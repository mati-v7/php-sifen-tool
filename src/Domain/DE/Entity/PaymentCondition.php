<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Entity;

use Nyxcode\PhpSifenTool\Domain\DE\Enum\OperationConditionType;

final class PaymentCondition
{
    /**
     * @param  CashPayment[]  $cashPayments
     */
    public function __construct(
        private readonly OperationConditionType $conditionType,
        private readonly array $cashPayments = [],
    ) {}

    public function conditionType(): OperationConditionType
    {
        return $this->conditionType;
    }

    /**
     * @return CashPayment[]
     */
    public function cashPayments(): array
    {
        return $this->cashPayments;
    }
}
