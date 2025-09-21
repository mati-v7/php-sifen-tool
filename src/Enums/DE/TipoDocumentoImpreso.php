<?php

namespace Nyxcode\PhpSifenTool\Enums\DE;

enum TipoDocumentoImpreso: int
{
    case FACTURA = 1;
    case NOTA_CREDITO = 2;
    case NOTA_DEBITO = 3;
    case NOTA_REMISION = 4;
    case COMPROBANTE_RETENCION = 5;

    public function getDescripcion(): string
    {
        return match ($this) {
            self::FACTURA => 'Factura',
            self::NOTA_CREDITO => 'Nota de crédito',
            self::NOTA_DEBITO => 'Nota de débito',
            self::NOTA_REMISION => 'Nota de remisión',
            self::COMPROBANTE_RETENCION => 'Comprobante de retención',
        };
    }
}
