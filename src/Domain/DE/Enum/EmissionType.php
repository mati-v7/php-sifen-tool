<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Enum;

enum EmissionType: int
{
    case NORMAL = 1;

    case CONTINGENCY = 2;

    public function description(): string
    {
        return match ($this) {
            self::NORMAL => 'Normal',
            self::CONTINGENCY => 'Contingencia',
        };
    }
}
