<?php

namespace Nyxcode\PhpSifenTool\Enums\DE;

enum TipoDocumentoResponsable: int
{
    case CEDULA_PARAGUAYA = 1;
    case PASAPORTE = 2;
    case CEDULA_EXTRANJERA = 3;
    case CARNET_RESIDENCIA = 4;
    case OTRO = 9;

    public function getDescripcion(): string
    {
        return match ($this) {
            self::CEDULA_PARAGUAYA => 'Cédula paraguaya',
            self::PASAPORTE => 'Pasaporte',
            self::CEDULA_EXTRANJERA => 'Cédula extranjera',
            self::CARNET_RESIDENCIA => 'Carnet de residencia',
            self::OTRO => 'Otro',
        };
    }
}
