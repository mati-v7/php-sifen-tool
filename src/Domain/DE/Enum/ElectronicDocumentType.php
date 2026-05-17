<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Enum;

enum ElectronicDocumentType: int
{
    case ELECTRONIC_INVOICE = 1;
    case ELECTRONIC_EXPORT_INVOICE = 2;
    case ELECTRONIC_IMPORT_INVOICE = 3;
    case ELECTRONIC_SELF_BILLED_INVOICE = 4;
    case ELECTRONIC_CREDIT_NOTE = 5;
    case ELECTRONIC_DEBIT_NOTE = 6;
    case ELECTRONIC_DELIVERY_NOTE = 7;
    case ELECTRONIC_WITHHOLDING_CERTIFICATE = 8;

    public function description(): string
    {
        return match ($this) {
            self::ELECTRONIC_INVOICE => 'Factura electrónica',
            self::ELECTRONIC_EXPORT_INVOICE => 'Factura electrónica de exportación',
            self::ELECTRONIC_IMPORT_INVOICE => 'Factura electrónica de importación',
            self::ELECTRONIC_SELF_BILLED_INVOICE => 'Autofactura electrónica',
            self::ELECTRONIC_CREDIT_NOTE => 'Nota de crédito electrónica',
            self::ELECTRONIC_DEBIT_NOTE => 'Nota de débito electrónica',
            self::ELECTRONIC_DELIVERY_NOTE => 'Nota de remisión electrónica',
            self::ELECTRONIC_WITHHOLDING_CERTIFICATE => 'Comprobante de retención electrónico',
        };
    }
}
