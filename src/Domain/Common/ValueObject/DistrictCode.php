<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

final readonly class DistrictCode
{
    public function __construct(
        private int $code,
        private string $description,
    ) {}

    public function code(): int
    {
        return $this->code;
    }

    public function description(): string
    {
        return $this->description;
    }
}
