<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Entity;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\DocumentNumber;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\EstablishmentCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ExpeditionPoint;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Serie;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\TaxAuthorizationNumber;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\ElectronicDocumentType;

final class TaxAuthorization
{
    public function __construct(
        private readonly ElectronicDocumentType $documentType,
        private readonly TaxAuthorizationNumber $number,
        private readonly EstablishmentCode $establishment,
        private readonly ExpeditionPoint $expeditionPoint,
        private readonly DocumentNumber $documentNumber,
        private readonly \DateTimeImmutable $validFrom,
        private readonly ?Serie $serie,
    ) {}

    public function documentType(): ElectronicDocumentType
    {
        return $this->documentType;
    }

    public function number(): TaxAuthorizationNumber
    {
        return $this->number;
    }

    public function establishment(): EstablishmentCode
    {
        return $this->establishment;
    }

    public function expeditionPoint(): ExpeditionPoint
    {
        return $this->expeditionPoint;
    }

    public function documentNumber(): DocumentNumber
    {
        return $this->documentNumber;
    }

    public function validFrom(): \DateTimeImmutable
    {
        return $this->validFrom;
    }

    public function serie(): ?Serie
    {
        return $this->serie;
    }
}
