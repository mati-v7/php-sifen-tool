<?php

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Contracts\ReceiverDocument;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\IdentityDocumentType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\TaxpayerType;
use Override;

final readonly class TaxpayerDocument implements ReceiverDocument
{
    public function __construct(
        private Ruc $ruc,
        private TaxpayerType $taxpayerType
    ) {
        //
    }

    #[Override]
    public function ruc(): Ruc
    {
        return $this->ruc;
    }

    #[Override]
    public function taxpayerType(): TaxpayerType
    {
        return $this->taxpayerType;
    }

    #[Override]
    public function documentType(): IdentityDocumentType
    {
        throw new \Exception('Not implemented');
    }

    #[Override]
    public function number(): string
    {
        throw new \Exception('Not implemented');
    }
}
