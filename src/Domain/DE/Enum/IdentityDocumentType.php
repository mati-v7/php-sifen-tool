<?php

namespace Nyxcode\PhpSifenTool\Domain\DE\Enum;

use DomainException;

enum IdentityDocumentType: int
{
    case NATIONAL_ID = 1;
    case PASSPORT = 2;
    case FOREIGN_ID = 3;
    case RESIDENCE_PERMIT = 4;
    case UNIDENTIFIED = 5;
    case DIPLOMATIC_TAX_EXEMPTION_CARD = 6;
    case OTHER = 9;

    public function description(): string
    {
        return match ($this) {
            self::NATIONAL_ID => 'Cédula paraguaya',
            self::PASSPORT => 'Pasaporte',
            self::FOREIGN_ID => 'Cédula extranjera',
            self::RESIDENCE_PERMIT => 'Carnet de residencia',
            self::UNIDENTIFIED => 'Innominado',
            self::DIPLOMATIC_TAX_EXEMPTION_CARD => 'Tarjeta Diplomática de exoneración fiscal',
            default => throw new DomainException(
                sprintf(
                    'No description found for "%s".',
                    $this->name
                )
            )
        };
    }

    public function isUnidentified(): bool
    {
        return $this === self::UNIDENTIFIED;
    }
}
