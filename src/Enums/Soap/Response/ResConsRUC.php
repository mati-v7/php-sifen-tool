<?php

namespace Nyxcode\PhpSifenTool\Enums\Soap\Response;

enum ResConsRUC: string
{
    case ACTIVO = 'ACT';
    case SUSPENDIDO = 'SUS';
    case SUSPENCION_ADMINISTRATIVA = 'SAD';
    case BLOQUEADO = 'BLQ';
    case CANCELADO = 'CAN';
    case CANCELADO_DEFINITIVO = 'CDE';
    case ES_FACTURADOR = 'S';
    case NO_ES_FACTURADOR = 'N';

    public function description(): string
    {
        return match ($this) {
            self::ACTIVO => 'Activo',
            self::SUSPENDIDO => 'Suspendido',
            self::SUSPENCION_ADMINISTRATIVA => 'Suspensión Administrativa',
            self::BLOQUEADO => 'Bloqueado',
            self::CANCELADO => 'Cancelado',
            self::CANCELADO_DEFINITIVO => 'Cancelado Definitivo',
            self::ES_FACTURADOR => 'Es facturador electrónico',
            self::NO_ES_FACTURADOR => 'No es facturador electrónico',
        };
    }
}
