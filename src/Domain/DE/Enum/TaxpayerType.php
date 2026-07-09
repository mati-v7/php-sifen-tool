<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Enum;

enum TaxpayerType: int
{
    case INDIVIDUAL = 1;
    case LEGAL_ENTITY = 2;
}
