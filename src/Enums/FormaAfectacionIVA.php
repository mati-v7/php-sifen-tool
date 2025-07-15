<?php

namespace Nyxcode\PhpSifenTool\Enums;

enum FormaAfectacionIVA: int
{
    case GRAVADO = 1;
    case EXONERADO = 2;
    case EXENTO = 3;
    case GRAVADO_PARCIAL = 4;

    public function getDescripcion(): string
    {
        return match ($this) {
            self::GRAVADO => 'Gravado IVA',
            self::EXONERADO => 'Exonerado (Art. 83- Ley 125/91)',
            self::EXENTO => 'Exento',
            self::GRAVADO_PARCIAL => 'Gravado parcial (Grav-Exento)',
        };
    }
}
