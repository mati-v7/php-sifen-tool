<?php

namespace Nyxcode\PhpSifenTool\Domain\DE\Enum;

enum IdentityDocumentType: int
{
    case NATIONAL_ID = 1;
    case PASSPORT = 2;
    case FOREIGN_ID = 3;
    case RESIDENCE_PERMIT = 4;
    case UNIDENTIFIED = 5;
    case DIPLOMATIC_TAX_EXEMPTION_CARD = 6;
    case OTHER = 9;
}
