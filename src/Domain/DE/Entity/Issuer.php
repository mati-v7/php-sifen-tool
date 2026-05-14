<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Entity;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Ruc;

final class Issuer
{
    public function __construct(
        private readonly Ruc $ruc,
        private readonly string $name,
    ) {}

    public function ruc(): Ruc
    {
        return $this->ruc;
    }

    public function name(): string
    {
        return $this->name;
    }
}
