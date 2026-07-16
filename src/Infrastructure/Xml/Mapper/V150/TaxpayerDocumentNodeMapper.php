<?php

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Contracts\ReceiverDocument;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\TaxpayerDocument;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Receiver;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\ReceiverDocumentNodeMapper;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;
use Override;

final readonly class TaxpayerDocumentNodeMapper implements ReceiverDocumentNodeMapper
{
    public function supports(ReceiverDocument $document): bool
    {
        return $document instanceof TaxpayerDocument;
    }

    #[Override]
    public function map(XmlElement $parentNode, Receiver $receiver): void
    {
        /** @var TaxpayerDocument $document */
        $document = $receiver->document();

        $parentNode->addChild(
            XmlElement::make(
                'dRucRec',
                $document->ruc()->value()
            )
        );

        $parentNode->addChild(
            XmlElement::make(
                'dDVRuc',
                $document->ruc()->checkDigit()
            )
        );
    }
}
