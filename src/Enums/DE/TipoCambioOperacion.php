<?php

namespace Nyxcode\PhpSifenTool\Enums\DE;

enum TipoCambioOperacion: int
{
    case GLOBAL = 1;
    case ITEM = 2;

    public function getDescripcion(): string
    {
        return match ($this) {
            self::GLOBAL => 'Global',
            self::ITEM => 'Por ítem',
        };
    }
}
