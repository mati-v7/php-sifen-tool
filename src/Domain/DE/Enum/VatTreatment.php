<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Enum;

enum VatTreatment: int
{
    case VAT_TAXABLE = 1;
    case VAT_EXONERATED = 2;
    case VAT_EXEMPT = 3;
    case VAT_PARTIALLY_TAXABLE = 4;
}
