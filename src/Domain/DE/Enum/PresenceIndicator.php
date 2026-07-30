<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Enum;

use DomainException;

enum PresenceIndicator: int
{
    case IN_PERSON = 1;
    case ONLINE = 2;
    case TELEMARKETING = 3;
    case HOME_DELIVERY = 4;
    case BANKING_OPERATION = 5;
    case CYCLICAL_OPERATION = 6;
    case OTHER = 9;

    public function description(): string
    {
        return match ($this) {
            self::IN_PERSON => 'Operación presencial',
            self::ONLINE => 'Operación electrónica',
            self::TELEMARKETING => 'Operación telemarketing',
            self::HOME_DELIVERY => 'Venta a domicilio',
            self::BANKING_OPERATION => 'Operación bancaria',
            self::CYCLICAL_OPERATION => 'Operación cíclica',
            default => throw new DomainException(
                sprintf(
                    'No description found for "%s".',
                    $this->name
                )
            )
        };
    }

    public function isOther(): bool
    {
        return $this === self::OTHER;
    }
}
