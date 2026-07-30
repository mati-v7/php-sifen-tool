<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Enum;

enum CreditConditionType: int
{
    case TERM = 1;

    case INSTALLMENT = 2;

    public function description(): string
    {
        return match ($this) {
            self::TERM => 'Plazo',
            self::INSTALLMENT => 'Cuota',
        };
    }
}
