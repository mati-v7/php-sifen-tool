<?php

namespace Nyxcode\PhpSifenTool\Enums\DE;

enum FormaProcesamientoTarjeta: int
{
    case POS = 1;
    case PAGO_ELECTRONICO = 2;
    case OTRO = 9;

    public function getDescripcion(): string
    {
        return match ($this) {
            self::POS => 'POS',
            self::PAGO_ELECTRONICO => 'Pago Electrónico',
            self::OTRO => 'Otro',
        };
    }
}
