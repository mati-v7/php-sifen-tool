<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Entity;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Address;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Contracts\ReceiverDocument;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\CountryCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\CustomerCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\EmailAddress;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\PhoneNumber;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\OperationType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\ReceiverNature;

final class Receiver
{
    public function __construct(
        private readonly ReceiverNature $nature,
        private readonly OperationType $operation,
        private readonly CountryCode $countryCode,
        private readonly ReceiverDocument $document,
        private readonly string $legalName,
        private readonly ?string $fantasyName,
        private readonly ?Address $address,
        private readonly ?PhoneNumber $phone,
        private readonly ?PhoneNumber $cellphone,
        private readonly ?EmailAddress $email,
        private readonly ?CustomerCode $customerCode,
    ) {}

    public function nature(): ReceiverNature
    {
        return $this->nature;
    }

    public function operation(): OperationType
    {
        return $this->operation;
    }

    public function country(): CountryCode
    {
        return $this->countryCode;
    }

    public function document(): ReceiverDocument
    {
        return $this->document;
    }

    public function legalName(): string
    {
        return $this->legalName;
    }

    public function fantasyName(): ?string
    {
        return $this->fantasyName;
    }

    public function address(): ?Address
    {
        return $this->address;
    }

    public function phone(): ?PhoneNumber
    {
        return $this->phone;
    }

    public function cellphone(): ?PhoneNumber
    {
        return $this->phone;
    }

    public function email(): ?EmailAddress
    {
        return $this->email;
    }

    public function customerCode(): ?CustomerCode
    {
        return $this->customerCode;
    }
}
