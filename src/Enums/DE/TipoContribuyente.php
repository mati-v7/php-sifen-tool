<?php

namespace Nyxcode\PhpSifenTool\Enums\DE;

enum TipoContribuyente: int
{
    case PERSONA_FISICA = 1;
    case PERSONA_JURIDICA = 2;

    public function getDescripcion(): string
    {
        return match ($this) {
            self::PERSONA_FISICA => 'Persona Física',
            self::PERSONA_JURIDICA => 'Persona Jurídica',
        };
    }
}
