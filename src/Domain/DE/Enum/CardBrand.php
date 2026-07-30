<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Enum;

enum CardBrand: int
{
    case VISA = 1;

    case MASTERCARD = 2;

    case AMERICAN_EXPRESS = 3;

    case MAESTRO = 4;

    case PANAL = 5;

    case CABAL = 6;

    case OTHER = 99;

    public function description(): string
    {
        return match ($this) {
            self::VISA => 'Visa',
            self::MASTERCARD => 'Mastercard',
            self::AMERICAN_EXPRESS => 'American Express',
            self::MAESTRO => 'Maestro',
            self::PANAL => 'Panal',
            self::CABAL => 'Cabal',
            self::OTHER => throw new \LogicException(
                'Card brand "Otro" (99) has no fixed description; a custom description must be provided.'
            ),
        };
    }
}
