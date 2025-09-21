<?php

namespace Nyxcode\PhpSifenTool\Enums\DE;

enum TipoTransaccion: int
{
    case VENTA_MERCADERIA = 1;
    case PRESTACION_SERVICIOS = 2;
    case MIXTO = 3;
    case VENTA_ACTIVO_FIJO = 4;
    case VENTA_DIVISAS = 5;
    case COMPRA_DIVISAS = 6;
    case PROMOCION_MUESTRAS = 7;
    case DONACION = 8;
    case ANTICIPO = 9;
    case COMPRA_PRODUCTOS = 10;
    case COMPRA_SERVICIOS = 11;
    case VENTA_CREDITO_FISCAL = 12;
    case MUESTA_MEDICA = 13;

    public function getDescripcion(): string
    {
        return match ($this) {
            self::VENTA_MERCADERIA => 'Venta de mercadería',
            self::PRESTACION_SERVICIOS => 'Prestación de servicios',
            self::MIXTO => 'Mixto',
            self::VENTA_ACTIVO_FIJO => 'Venta de activo fijo',
            self::VENTA_DIVISAS => 'Venta de divisas',
            self::COMPRA_DIVISAS => 'Compra de divisas',
            self::PROMOCION_MUESTRAS => 'Promoción o entrega de muestras',
            self::DONACION => 'Donación',
            self::ANTICIPO => 'Anticipo',
            self::COMPRA_PRODUCTOS => 'Compra de productos',
            self::COMPRA_SERVICIOS => 'Compra de servicios',
            self::VENTA_CREDITO_FISCAL => 'Venta de crédito fiscal',
            self::MUESTA_MEDICA => 'Muestras médicas (Art. 3 RG24/2014)',
        };
    }
}
