<?php

namespace Nyxcode\PhpSifenTool\Enums;

enum TipoCondicionOperacion: int
{
    case CONTADO = 1;
    case CREDITO = 2;

    public function getDescripcion(): string
    {
        return match ($this) {
            self::CONTADO => 'Contado',
            self::CREDITO => 'Crédito',
        };
    }
}
