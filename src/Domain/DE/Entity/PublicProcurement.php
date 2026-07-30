<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Entity;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ContractingEntityCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ContractModalityCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ContractSequenceCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ContractYearCode;

final class PublicProcurement
{
    public function __construct(
        private readonly ContractModalityCode $modality,
        private readonly ContractingEntityCode $entity,
        private readonly ContractYearCode $year,
        private readonly ContractSequenceCode $sequence,
        private readonly \DateTimeImmutable $codeIssuedAt,
    ) {}

    public function modality(): ContractModalityCode
    {
        return $this->modality;
    }

    public function entity(): ContractingEntityCode
    {
        return $this->entity;
    }

    public function year(): ContractYearCode
    {
        return $this->year;
    }

    public function sequence(): ContractSequenceCode
    {
        return $this->sequence;
    }

    public function codeIssuedAt(): \DateTimeImmutable
    {
        return $this->codeIssuedAt;
    }
}
