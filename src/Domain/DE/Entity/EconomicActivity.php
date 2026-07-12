<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Entity;

final readonly class EconomicActivity
{
    public function __construct(
        private string $code,
        private string $description,
    ) {}

    public function code(): string
    {
        return $this->code;
    }

    public function description(): string
    {
        return $this->description;
    }
}
