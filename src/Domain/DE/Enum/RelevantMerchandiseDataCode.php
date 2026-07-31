<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Enum;

enum RelevantMerchandiseDataCode: int
{
    case BREAKAGE_TOLERANCE = 1;

    case SHRINKAGE_TOLERANCE = 2;

    public function description(): string
    {
        return match ($this) {
            self::BREAKAGE_TOLERANCE => 'Tolerancia de quiebra',
            self::SHRINKAGE_TOLERANCE => 'Tolerancia de merma',
        };
    }
}
