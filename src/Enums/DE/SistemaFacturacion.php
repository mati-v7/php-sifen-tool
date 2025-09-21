<?php

namespace Nyxcode\PhpSifenTool\Enums\DE;

enum SistemaFacturacion: int
{
    case CONTRIBUYENTE = 1;
    case GRATUITO = 2;

    public function getDescripcion(): string
    {
        return match ($this) {
            self::CONTRIBUYENTE => 'Sistema de facturación del contribuyente',
            self::GRATUITO => 'SIFEN solución gratuita',
        };
    }
}
