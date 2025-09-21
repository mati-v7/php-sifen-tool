<?php

namespace Nyxcode\PhpSifenTool\Enums\DE;

enum MonedaOperacion: string
{
    case PYG = "PYG";
    case USD = "USD";

    public function getDescripcion(): string
    {
        return match ($this) {
            self::PYG => 'Guarani',
            self::USD => 'Dollar',
        };
    }
}
