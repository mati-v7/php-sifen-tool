<?php

namespace Nyxcode\PhpSifenTool\Enums;

enum TipoPago: int
{
    case EFECTIVO = 1;
    case CHEQUE = 2;
    case TARJETA_CREDITO = 3;
    case TARJETA_DEBITO = 4;
    case TRANSFERENCIA = 5;
    case GIRO = 6;
    case BILLETERA_ELECTRONICA = 7;
    case TARJETA_EMPRESARIAL = 8;
    case VALE = 9;
    case RETENCION = 10;
    case PAGO_ANTICIPO = 11;
    case VALOR_FISCAL = 12;
    case VALOR_COMERCIAL = 13;
    case COMPENSACION = 14;
    case PERMUTA = 15;
    case PAGO_BANCARIO = 16;
    case PAGO_MOVIL = 17;
    case DONACION = 18;
    case PROMOCION = 19;
    case CONSUMO_INTERNO = 20;
    case PAGO_ELECTRONICO = 21;
    case OTRO = 99;

    public function getDescripcion(): string
    {
        return match ($this) {
            self::EFECTIVO => 'Efectivo',
            self::CHEQUE => 'Cheque',
            self::TARJETA_CREDITO => 'Tarjeta de crédito',
            self::TARJETA_DEBITO => 'Tarjeta de débito',
            self::TRANSFERENCIA => 'Transferencia',
            self::GIRO => 'Giro',
            self::BILLETERA_ELECTRONICA => 'Billetera electrónica',
            self::TARJETA_EMPRESARIAL => 'Tarjeta empresarial',
            self::VALE => 'Vale',
            self::RETENCION => 'Retención',
            self::PAGO_ANTICIPO => 'Pago por anticipo',
            self::VALOR_FISCAL => 'Valor fiscal',
            self::VALOR_COMERCIAL => 'Valor comercial',
            self::COMPENSACION => 'Compensación',
            self::PERMUTA => 'Permuta',
            self::PAGO_BANCARIO => 'Pago bancario',
            self::PAGO_MOVIL => 'Pago Móvil',
            self::DONACION => 'Donación',
            self::PROMOCION => 'Promoción',
            self::CONSUMO_INTERNO => 'Consumo interno',
            self::PAGO_ELECTRONICO => 'Pago Electrónico',
            self::OTRO => 'Otro',
        };
    }
}
