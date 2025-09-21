<?php

namespace Nyxcode\PhpSifenTool\Enums\DE;

enum TipoConstancia: int
{
    case CONSTANCIA_NO_SER_CONTRIBUYENTE = 1;
    case CONSTANCIA_MICROPRODUCTORES = 2;

    public function getDescripcion(): string
    {
        return match ($this) {
            self::CONSTANCIA_NO_SER_CONTRIBUYENTE => 'Constancia de no ser contribuyente',
            self::CONSTANCIA_MICROPRODUCTORES => 'Constancia de microproductores',
        };
    }
}
