<?php

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Contracts\ReceiverDocument;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\IdentityDocument;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Receiver;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\ReceiverDocumentNodeMapper;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;
use Override;

final readonly class IdentityDocumentNodeMapper implements ReceiverDocumentNodeMapper
{
    #[Override]
    public function supports(ReceiverDocument $document): bool
    {
        return $document instanceof IdentityDocument;
    }

    #[Override]
    public function map(XmlElement $parentNode, Receiver $receiver): void
    {
        /** @var IdentityDocument $document */
        $document = $receiver->document();

        $documentType = $document->documentType();
        $isUnidentified = $documentType->isUnidentified();
        $legalName = $isUnidentified
            ? 'Sin Nombre' : $receiver->legalName();

        if ($receiver->operation()->isForeign()) {
            $parentNode->addChild(
                XmlElement::make(
                    'dNomRec',
                    $legalName
                )
            );

            return;
        }

        $parentNode->addChild(
            XmlElement::make(
                'iTipIDRec',
                (string) $documentType->value
            )
        );

        $parentNode->addChild(
            XmlElement::make(
                'dDTipIDRec',
                $documentType->description()
            )
        );

        $parentNode->addChild(
            XmlElement::make(
                'dNumIDRec',
                $isUnidentified ? '0' : $document->number()
            )
        );

        $parentNode->addChild(
            XmlElement::make(
                'dNomRec',
                $legalName
            )
        );
    }
}
