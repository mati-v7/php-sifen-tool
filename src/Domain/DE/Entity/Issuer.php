<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Entity;

use Nyxcode\PhpSifenTool\Domain\Common\Collection\EconomicActivityCollection;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Address;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\BranchName;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\BusinessName;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\EmailAddress;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\PhoneNumber;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Ruc;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\TradeName;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\TaxpayerType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\TaxRegimeType;

final class Issuer
{
    public function __construct(
        private readonly Ruc $ruc,
        private readonly TaxpayerType $taxpayerType,
        private readonly ?TaxRegimeType $taxRegimeType,
        private readonly BusinessName $name,
        private readonly ?BranchName $branchName,
        private readonly ?TradeName $tradeName,
        private readonly Address $address,
        private readonly PhoneNumber $phoneNumber,
        private readonly EmailAddress $emailAddress,
        private readonly EconomicActivityCollection $activities,
        private readonly ?DEResponsible $responsible = null,
    ) {}

    public function ruc(): Ruc
    {
        return $this->ruc;
    }

    public function taxpayerType(): TaxpayerType
    {
        return $this->taxpayerType;
    }

    public function taxRegimeType(): ?TaxRegimeType
    {
        return $this->taxRegimeType;
    }

    public function name(): BusinessName
    {
        return $this->name;
    }

    public function tradeName(): ?TradeName
    {
        return $this->tradeName;
    }

    public function address(): Address
    {
        return $this->address;
    }

    public function phoneNumber(): PhoneNumber
    {
        return $this->phoneNumber;
    }

    public function emailAddress(): EmailAddress
    {
        return $this->emailAddress;
    }

    public function branchName(): ?BranchName
    {
        return $this->branchName;
    }

    public function activities(): EconomicActivityCollection
    {
        return $this->activities;
    }

    public function responsible(): ?DEResponsible
    {
        return $this->responsible;
    }
}
