<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Entity;

use Nyxcode\PhpSifenTool\Domain\DE\Enum\PresenceIndicator;

final class InvoiceData
{
    public function __construct(
        private readonly PresenceIndicator $presenceIndicator,
    ) {}

    public function presenceIndicator(): PresenceIndicator
    {
        return $this->presenceIndicator;
    }
}
