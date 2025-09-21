<?php

namespace Nyxcode\PhpSifenTool\Enums\DE;

enum TipoRegimen: int
{
    case TURISMO = 1;
    case IMPORTADOR = 2;
    case EXPORTADOR = 3;
    case MAQUILA = 4;
    case LEY_6090 = 5;
    case PEQUENO_PRODUCTOR = 6;
    case MEDIANO_PRODUCTOR = 7;
    case CONTABLE = 8;

    public function getDescripcion(): string
    {
        return match ($this) {
            self::TURISMO => 'Régimen de Turismo',
            self::IMPORTADOR => 'Importadora',
            self::EXPORTADOR => 'Exportador',
            self::MAQUILA => 'Maquila',
            self::LEY_6090 => 'Ley N° 60/90',
            self::PEQUENO_PRODUCTOR => 'Régimen del Pequeño Productor',
            self::MEDIANO_PRODUCTOR => 'Régimen del Mediano Productor',
            self::CONTABLE => 'Régimen Contable',
        };
    }
}
