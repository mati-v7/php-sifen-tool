<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Enum;

enum PaymentType: int
{
    case CASH = 1;

    case CHECK = 2;

    case CREDIT_CARD = 3;

    case DEBIT_CARD = 4;

    case TRANSFER = 5;

    case MONEY_ORDER = 6;

    case ELECTRONIC_WALLET = 7;

    case CORPORATE_CARD = 8;

    case VOUCHER = 9;

    case WITHHOLDING = 10;

    case ADVANCE_PAYMENT = 11;

    case FISCAL_VALUE = 12;

    case COMMERCIAL_VALUE = 13;

    case COMPENSATION = 14;

    case BARTER = 15;

    case BANK_PAYMENT = 16;

    case MOBILE_PAYMENT = 17;

    case DONATION = 18;

    case PROMOTION = 19;

    case INTERNAL_CONSUMPTION = 20;

    case ELECTRONIC_PAYMENT = 21;

    case OTHER = 99;

    public function description(): string
    {
        return match ($this) {
            self::CASH => 'Efectivo',
            self::CHECK => 'Cheque',
            self::CREDIT_CARD => 'Tarjeta de crédito',
            self::DEBIT_CARD => 'Tarjeta de débito',
            self::TRANSFER => 'Transferencia',
            self::MONEY_ORDER => 'Giro',
            self::ELECTRONIC_WALLET => 'Billetera electrónica',
            self::CORPORATE_CARD => 'Tarjeta empresarial',
            self::VOUCHER => 'Vale',
            self::WITHHOLDING => 'Retención',
            self::ADVANCE_PAYMENT => 'Pago por anticipo',
            self::FISCAL_VALUE => 'Valor fiscal',
            self::COMMERCIAL_VALUE => 'Valor comercial',
            self::COMPENSATION => 'Compensación',
            self::BARTER => 'Permuta',
            self::BANK_PAYMENT => 'Pago bancario',
            self::MOBILE_PAYMENT => 'Pago Móvil',
            self::DONATION => 'Donación',
            self::PROMOTION => 'Promoción',
            self::INTERNAL_CONSUMPTION => 'Consumo Interno',
            self::ELECTRONIC_PAYMENT => 'Pago Electrónico',
            self::OTHER => throw new \LogicException(
                'Payment type "Otro" (99) has no fixed description; a custom description must be provided.'
            ),
        };
    }
}
