<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Entity;

use InvalidArgumentException;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\PresenceIndicator;

final class InvoiceData
{
    public function __construct(
        private readonly PresenceIndicator $presenceIndicator,
        private readonly ?string $customPresenceIndicatorDescription = null,
        private readonly ?\DateTimeImmutable $futureDeliveryDate = null,
    ) {
        if ($this->presenceIndicator->isOther()) {
            $length = mb_strlen((string) $customPresenceIndicatorDescription);

            if ($length < 10 || $length > 30) {
                throw new InvalidArgumentException(
                    'Presence indicator description must be provided and be between 10 and 30 characters when the presence indicator is "Otro".'
                );
            }
        }
    }

    public function presenceIndicator(): PresenceIndicator
    {
        return $this->presenceIndicator;
    }

    public function presenceIndicatorDescription(): string
    {
        return $this->presenceIndicator->isOther()
            ? (string) $this->customPresenceIndicatorDescription
            : $this->presenceIndicator->description();
    }

    public function futureDeliveryDate(): ?\DateTimeImmutable
    {
        return $this->futureDeliveryDate;
    }
}
