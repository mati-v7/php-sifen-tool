<?php

namespace Nyxcode\PhpSifenTool\Enums\DE;

enum TipoDocumentoElectronico: int
{
    case FE = 1;
    case FEE = 2;
    case FEI = 3;
    case AE = 4;
    case NCE = 5;
    case NDE = 6;
    case NRE = 7;
    case CRE = 8;

    public function getDescripcion(): string
    {
        return match ($this) {
            self::FE => 'Factura electrónica',
            self::FEE => 'Factura electrónica de exportación',
            self::FEI => 'Factura electrónica de importación',
            self::AE => 'Autofactura electrónica',
            self::NCE => 'Nota de crédito electrónica',
            self::NDE => 'Nota de débito electrónica',
            self::NRE => 'Nota de remisión electrónica',
            self::CRE => 'Comprobante de retención electrónico',
        };
    }
}
