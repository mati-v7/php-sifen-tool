<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Entity;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\DocumentNumber;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\EstablishmentCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ExpeditionPoint;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\TaxAuthorizationNumber;

final class TaxAuthorization
{
    public function __construct(
        private readonly TaxAuthorizationNumber $number,
        private readonly EstablishmentCode $establishment,
        private readonly ExpeditionPoint $expeditionPoint,
        private readonly DocumentNumber $documentNumber,
    ) {}

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
}
