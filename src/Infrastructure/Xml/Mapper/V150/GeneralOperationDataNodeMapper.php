<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\ElectronicDocument;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\XmlNodeMapperInterface;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;
use Override;

final class GeneralOperationDataNodeMapper implements XmlNodeMapperInterface
{
    #[Override]
    public function map(ElectronicDocument $document): XmlElement
    {
        $node = XmlElement::make('gDatGralOpe');

        $node->addChild(
            XmlElement::make(
                'dFeEmiDE',
                $document->issuedAt()->format('Y-m-d\TH:i:s')
            )
        );

        $node->addChild(
            (new IssuerNodeMapper)
                ->map($document)
        );

        $node->addChild(
            (new ReceiverNodeMapper)
                ->map($document)
        );

        return $node;
    }
}
