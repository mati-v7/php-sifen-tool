<?php

namespace Nyxcode\PhpSifenTool\Domain\DE\Enum;

enum OperationType: int
{
    case B2B = 1;
    case B2C = 2;
    case B2G = 3;
    case B2F = 4;

    public function isForeign(): bool
    {
        return $this === self::B2F;
    }
}
