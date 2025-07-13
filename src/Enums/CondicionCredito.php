<?php

namespace Nyxcode\PhpSifenTool\Enums;

enum CondicionCredito: int
{
    case PLAZO = 1;
    case CUOTA = 2;

    public function getDescripcion(): string
    {
        return match ($this) {
            self::PLAZO => 'Plazo',
            self::CUOTA => 'Cuota',
        };
    }
}
