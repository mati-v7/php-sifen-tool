<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Entity;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\SecurityCode;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\EmissionType;

final class Operation
{
    public function __construct(
        private readonly EmissionType $emissionType,
        private readonly SecurityCode $securityCode,
    ) {}

    public function emissionType(): EmissionType
    {
        return $this->emissionType;
    }

    public function securityCode(): SecurityCode
    {
        return $this->securityCode;
    }
}
