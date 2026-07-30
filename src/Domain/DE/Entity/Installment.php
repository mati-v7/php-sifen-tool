<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Entity;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Money;

final class Installment
{
    public function __construct(
        private readonly Money $amount,
        private readonly ?\DateTimeImmutable $dueDate = null,
    ) {}

    public function amount(): Money
    {
        return $this->amount;
    }

    public function dueDate(): ?\DateTimeImmutable
    {
        return $this->dueDate;
    }
}
