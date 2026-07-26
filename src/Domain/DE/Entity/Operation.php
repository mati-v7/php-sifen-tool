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
        private readonly ?string $issuerInfo,
        private readonly ?string $fiscalInfo,
    ) {}

    public function emissionType(): EmissionType
    {
        return $this->emissionType;
    }

    public function securityCode(): SecurityCode
    {
        return $this->securityCode;
    }

    public function issuerInfo(): ?string
    {
        return $this->issuerInfo;
    }

    public function fiscalInfo(): ?string
    {
        return $this->fiscalInfo;
    }
}
