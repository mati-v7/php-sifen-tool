<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Enum;

enum VatTreatment: int
{
    case VAT_TAXABLE = 1;
    case VAT_EXONERATED = 2;
    case VAT_EXEMPT = 3;
    case VAT_PARTIALLY_TAXABLE = 4;

    public function description(): string
    {
        return match ($this) {
            self::VAT_TAXABLE => 'Gravado IVA',
            self::VAT_EXONERATED => 'Exonerado (Art. 83- Ley 125/91)',
            self::VAT_EXEMPT => 'Exento',
            self::VAT_PARTIALLY_TAXABLE => 'Gravado parcial (Grav-Exento)',
        };
    }
}
