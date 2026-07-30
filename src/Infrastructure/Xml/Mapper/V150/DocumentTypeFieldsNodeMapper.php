<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\ElectronicDocument;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\ElectronicDocumentType;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\XmlNodeMapperInterface;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;
use Override;

final class DocumentTypeFieldsNodeMapper implements XmlNodeMapperInterface
{
    #[Override]
    public static function supports(): string
    {
        return ElectronicDocument::class;
    }

    public function map(ElectronicDocument $document): XmlElement
    {
        $node = XmlElement::make('gDtipDE');

        if ($document->taxAuthorization()->documentType() === ElectronicDocumentType::ELECTRONIC_INVOICE) {
            $node->addChild(
                (new InvoiceFieldsNodeMapper)
                    ->map($document->invoiceData())
            );
        }

        if (in_array($document->taxAuthorization()->documentType(), [
            ElectronicDocumentType::ELECTRONIC_INVOICE,
            ElectronicDocumentType::ELECTRONIC_SELF_BILLED_INVOICE,
        ], true)) {
            $node->addChild(
                (new OperationConditionFieldsNodeMapper)
                    ->map($document->paymentCondition())
            );
        }

        return $node;
    }
}
