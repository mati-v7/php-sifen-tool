<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

use Nyxcode\PhpSifenTool\Domain\DE\Enum\VatTreatment;

final readonly class ItemVat
{
    public function __construct(
        private VatTreatment $tratment,
        private Percentage $rate,
        private Percentage $taxableProportion
    ) {}

    public function tratment(): VatTreatment
    {
        return $this->tratment;
    }

    public function rate(): Percentage
    {
        return $this->rate;
    }

    public function taxableProportion(): Percentage
    {
        return $this->taxableProportion;
    }

    public function isExempt(): bool
    {
        return $this->tratment === VatTreatment::VAT_EXEMPT;
    }

    public function isUntaxed(): bool
    {
        return $this->tratment === VatTreatment::VAT_EXEMPT
            || $this->tratment === VatTreatment::VAT_EXONERATED;
    }
}
