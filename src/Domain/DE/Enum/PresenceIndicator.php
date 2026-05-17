<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Enum;

enum PresenceIndicator: int
{
    case IN_PERSON = 1;

    case ONLINE = 2;
}
