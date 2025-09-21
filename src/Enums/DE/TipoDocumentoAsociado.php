<?php

namespace Nyxcode\PhpSifenTool\Enums\DE;

enum TipoDocumentoAsociado: int
{
    case ELECTRONICO = 1;
    case IMPRESO = 2;
    case CONSTANCIA_ELECTRONICA = 3;

    public function getDescripcion(): string
    {
        return match ($this) {
            self::ELECTRONICO => 'Electrónico',
            self::IMPRESO => 'Impreso',
            self::CONSTANCIA_ELECTRONICA => 'Constancia Electrónica',
        };
    }
}
