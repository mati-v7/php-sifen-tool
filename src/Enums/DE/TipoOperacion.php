<?php

namespace Nyxcode\PhpSifenTool\Enums\DE;

enum TipoOperacion: int
{
    case B2B = 1;
    case B2C = 2;
    case B2G = 3;
    case B2F = 4;

    public function getDescripcion(): string
    {
        return match ($this) {
            self::B2B => 'Business-to-business',
            self::B2C => 'Business-to-consumer',
            self::B2G => 'Business-to-government',
            self::B2F => 'Business-to-foreign',
        };
    }
}
