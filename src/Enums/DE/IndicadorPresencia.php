<?php

namespace Nyxcode\PhpSifenTool\Enums\DE;

enum IndicadorPresencia: int
{
    case OPERACION_PRESENCIAL = 1;
    case OPERACION_ELECTRONICA = 2;
    case OPERACION_TELEMARKETING = 3;
    case VENTA_DOMICILIO = 4;
    case OPERACION_BANCARIA = 5;
    case OPERACION_CICLICA = 6;
    case OTRO = 9;

    public function getDescripcion(): string
    {
        return match ($this) {
            self::OPERACION_PRESENCIAL => 'Operación presencial',
            self::OPERACION_ELECTRONICA => 'Operación electrónica',
            self::OPERACION_TELEMARKETING => 'Operación telemarketing',
            self::VENTA_DOMICILIO => 'Venta a domicilio',
            self::OPERACION_BANCARIA => 'Operación bancaria',
            self::OPERACION_CICLICA => 'Operación cíclica',
            self::OTRO => 'Otro',
        };
    }
}
