<?php

namespace Nyxcode\PhpSifenTool\Enums;

enum RelevanciaMercaderia: int
{
    case TOLERANCIA_QUIEBRA = 1;
    case TOLERANCIA_MERMA = 2;

    public function getDescripcion(): string
    {
        return match ($this) {
            self::TOLERANCIA_QUIEBRA => 'Tolerancia de quiebra',
            self::TOLERANCIA_MERMA => 'Tolerancia de merma',
        };
    }
}
