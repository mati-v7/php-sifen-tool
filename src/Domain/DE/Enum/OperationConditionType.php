<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Enum;

enum OperationConditionType: int
{
    case CASH = 1;

    case CREDIT = 2;

    public function description(): string
    {
        return match ($this) {
            self::CASH => 'Contado',
            self::CREDIT => 'Crédito',
        };
    }
}
