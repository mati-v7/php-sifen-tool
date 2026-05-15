<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Calculator;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Money;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Percentage;

final class VatCalculator
{
    public function calculateVat(
        Money $total,
        Percentage $percentage,
    ): Money {
        $divisor = $percentage->value() + 100;

        return $total
            ->multiply($percentage->value())
            ->divide($divisor);
    }
}
