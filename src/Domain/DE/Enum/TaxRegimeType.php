<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Enum;

enum TaxRegimeType: int
{
    case TOURISM_REGIME = 1;
    case IMPORTER = 2;
    case EXPORTER = 3;
    case MAQUILA_REGIME = 4;
    case INVESTMENT_INCENTIVE_REGIME = 5;
    case SMALL_PRODUCER_REGIME = 6;
    case MEDIUM_PRODUCER_REGIME = 7;
    case ACCOUNTING_REGIME = 8;
}
