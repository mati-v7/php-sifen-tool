<?php

namespace Nyxcode\PhpSifenTool\Enums\DE;

enum NaturalezaReceptor: int
{
    case CONTRIBUYENTE = 1;
    case NO_CONTRIBUYENTE = 2;

    public function getDescripcion(): string
    {
        return match ($this) {
            self::CONTRIBUYENTE => 'contribuyente',
            self::NO_CONTRIBUYENTE => 'no contribuyente',
        };
    }
}
