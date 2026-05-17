<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Entity;

use Nyxcode\PhpSifenTool\Domain\DE\Enum\OperationConditionType;

final class PaymentCondition
{
    public function __construct(
        private readonly OperationConditionType $conditionType,
    ) {}

    public function conditionType(): OperationConditionType
    {
        return $this->conditionType;
    }
}
