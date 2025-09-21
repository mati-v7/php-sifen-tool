<?php

namespace Nyxcode\PhpSifenTool\Enums\DE;

enum DenominacionTarjeta: int
{
    case VISA = 1;
    case MASTERCARD = 2;
    case AMERICAN_EXPRESS = 3;
    case MAESTRO = 4;
    case PANAL = 5;
    case CABAL = 6;
    case OTRO = 99;

    public function getDescripcion(): string
    {
        return match ($this) {
            self::VISA => 'Visa',
            self::MASTERCARD => 'Mastercard',
            self::AMERICAN_EXPRESS => 'American Express',
            self::MAESTRO => 'Maestro',
            self::PANAL => 'Panal',
            self::CABAL => 'Cabal',
            self::OTRO => 'Otro',
        };
    }
}
