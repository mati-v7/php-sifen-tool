<?php

namespace Nyxcode\PhpSifenTool\Enums\DE;

enum TipoImpuesto: int
{
    case IVA = 1;
    case ISC = 2;
    case RENTA = 3;
    case NINGUNO = 4;
    case IVA_RENTA = 5;

    public function getDescripcion(): string
    {
        return match ($this) {
            self::IVA => 'IVA',
            self::ISC => 'ISC',
            self::RENTA => 'Renta',
            self::NINGUNO => 'Ninguno',
            self::IVA_RENTA => 'IVA - Renta',
        };
    }
}
