<?php

namespace Nyxcode\PhpSifenTool\Domain\DE\Enum;

enum ReceiverNature: int
{
    case TAXPAYER = 1;
    case NON_TAXPAYER = 2;

    public function isTaxpayer(): bool
    {
        return self::TAXPAYER === $this;
    }
}
