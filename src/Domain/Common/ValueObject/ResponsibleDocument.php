<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

use InvalidArgumentException;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\ResponsibleIdentityDocumentType;

final readonly class ResponsibleDocument
{
    public function __construct(
        private ResponsibleIdentityDocumentType $type,
        private string $number,
        private ?string $customDescription = null,
    ) {
        $numberLength = mb_strlen($number);

        if ($numberLength < 1 || $numberLength > 20) {
            throw new InvalidArgumentException(
                'Responsible document number must be between 1 and 20 characters.'
            );
        }

        if ($type->isOther()) {
            $descriptionLength = mb_strlen((string) $customDescription);

            if ($descriptionLength < 9 || $descriptionLength > 41) {
                throw new InvalidArgumentException(
                    'Document type description must be provided and be between 9 and 41 characters when the responsible document type is "Otro".'
                );
            }
        }
    }

    public function type(): ResponsibleIdentityDocumentType
    {
        return $this->type;
    }

    public function number(): string
    {
        return $this->number;
    }

    public function description(): string
    {
        return $this->type->isOther()
            ? (string) $this->customDescription
            : $this->type->description();
    }
}
