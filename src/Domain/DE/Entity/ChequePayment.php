<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Entity;

final class ChequePayment
{
    public function __construct(
        private readonly string $number,
        private readonly string $issuingBank,
    ) {}

    public function number(): string
    {
        return $this->number;
    }

    public function issuingBank(): string
    {
        return $this->issuingBank;
    }
}
