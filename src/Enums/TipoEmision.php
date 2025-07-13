<?php

namespace Nyxcode\PhpSifenTool\Enums;

enum TipoEmision: int
{
    case NORMAL = 1;
    case CONTINGENCIA = 2;

    public function getDescripcion(): string
    {
        return match ($this) {
            self::NORMAL => 'Normal',
            self::CONTINGENCIA => 'Contingencia',
        };
    }
}
