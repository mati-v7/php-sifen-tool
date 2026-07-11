<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

final readonly class CityCode
{
    public function __construct(
        private int $code
    ) {}

    public function value(): int
    {
        return $this->code;
    }
}
