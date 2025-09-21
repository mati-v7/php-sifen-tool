<?php

namespace Nyxcode\PhpSifenTool\Enums\DE;

enum TipoDocumentoReceptor: int
{
    case CEDULA_PARAGUAYA = 1;
    case PASAPORTE = 2;
    case CEDULA_EXTRANJERA = 3;
    case CARNET_RESIDENCIA = 4;
    case INNOMINADO = 5;
    case TARJETA_DIPLOMATICA = 6;
    case OTRO = 9;

    public function getDescripcion(): string
    {
        return match ($this) {
            self::CEDULA_PARAGUAYA => 'Cédula paraguaya',
            self::PASAPORTE => 'Pasaporte',
            self::CEDULA_EXTRANJERA => 'Cédula extranjera',
            self::CARNET_RESIDENCIA => 'Carnet de residencia',
            self::INNOMINADO => 'Innominado',
            self::TARJETA_DIPLOMATICA => 'Tarjeta Diplomática de exoneración fiscal',
            self::OTRO => 'Otro',
        };
    }
}
