<?php

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Contracts\ReceiverDocument;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\IdentityDocumentType;

final readonly class IdentityDocument implements ReceiverDocument
{
    public function __construct(
        private IdentityDocumentType $type,
        private string $number,
    ) {}

    public function type(): IdentityDocumentType
    {
        return $this->type;
    }

    public function number(): string
    {
        return $this->number;
    }
}
