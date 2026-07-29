<?php

namespace Nyxcode\PhpSifenTool\Domain\DE\Enum;

use DomainException;

enum ResponsibleIdentityDocumentType: int
{
    case NATIONAL_ID = 1;
    case PASSPORT = 2;
    case FOREIGN_ID = 3;
    case RESIDENCE_PERMIT = 4;
    case OTHER = 9;

    public function description(): string
    {
        return match ($this) {
            self::NATIONAL_ID => 'Cédula paraguaya',
            self::PASSPORT => 'Pasaporte',
            self::FOREIGN_ID => 'Cédula extranjera',
            self::RESIDENCE_PERMIT => 'Carnet de residencia',
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
