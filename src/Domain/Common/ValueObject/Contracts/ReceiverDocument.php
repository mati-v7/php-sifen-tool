<?php

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Contracts;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Ruc;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\IdentityDocumentType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\TaxpayerType;

interface ReceiverDocument
{
    public function ruc(): Ruc;

    public function taxpayerType(): TaxpayerType;

    public function documentType(): IdentityDocumentType;

    public function number(): string;
}
