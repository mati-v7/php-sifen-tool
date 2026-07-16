<?php

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Contracts\ReceiverDocument;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\IdentityDocumentType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\TaxpayerType;
use Override;

final readonly class IdentityDocument implements ReceiverDocument
{
    public function __construct(
        private IdentityDocumentType $type,
        private string $number,
    ) {}

    #[Override]
    public function documentType(): IdentityDocumentType
    {
        return $this->type;
    }

    #[Override]
    public function number(): string
    {
        return $this->number;
    }

    #[Override]
    public function ruc(): Ruc
    {
        throw new \Exception('Not implemented');
    }

    #[Override]
    public function taxpayerType(): TaxpayerType
    {
        throw new \Exception('Not implemented');
    }
}
