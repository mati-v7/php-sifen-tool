<?php

namespace Nyxcode\PhpSifenTool\Enums;

enum TipoCondicionAnticipo: int
{
    case GLOBAL = 1;
    case ITEM = 2;

    public function getDescripcion(): string
    {
        return match ($this) {
            self::GLOBAL => 'Anticipo Global',
            self::ITEM => 'Anticipo por Ítem',
        };
    }
}
