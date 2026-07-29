<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Tests\Unit\Domain\Common\ValueObject;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ResponsibleDocument;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\ResponsibleIdentityDocumentType;
use PHPUnit\Framework\TestCase;

final class ResponsibleDocumentTest extends TestCase
{
    public function test_uses_catalog_description_for_known_document_types(): void
    {
        $document = new ResponsibleDocument(
            ResponsibleIdentityDocumentType::NATIONAL_ID,
            '1234567'
        );

        $this->assertSame(ResponsibleIdentityDocumentType::NATIONAL_ID, $document->type());
        $this->assertSame('1234567', $document->number());
        $this->assertSame('Cédula paraguaya', $document->description());
    }

    public function test_uses_custom_description_when_type_is_other(): void
    {
        $document = new ResponsibleDocument(
            ResponsibleIdentityDocumentType::OTHER,
            '1234567',
            'Documento de identidad militar'
        );

        $this->assertSame('Documento de identidad militar', $document->description());
    }

    public function test_requires_custom_description_when_type_is_other(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new ResponsibleDocument(
            ResponsibleIdentityDocumentType::OTHER,
            '1234567'
        );
    }

    public function test_rejects_custom_description_outside_allowed_length(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new ResponsibleDocument(
            ResponsibleIdentityDocumentType::OTHER,
            '1234567',
            'Corto'
        );
    }

    public function test_rejects_document_number_outside_allowed_length(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new ResponsibleDocument(
            ResponsibleIdentityDocumentType::NATIONAL_ID,
            ''
        );
    }
}
