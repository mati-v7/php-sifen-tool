<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Enum;

enum CardPaymentProcessingType: int
{
    case POS = 1;

    case ELECTRONIC_PAYMENT = 2;

    case OTHER = 9;
}
