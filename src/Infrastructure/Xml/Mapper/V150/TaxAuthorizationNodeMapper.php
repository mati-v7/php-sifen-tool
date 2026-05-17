<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\ElectronicDocument;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\XmlNodeMapperInterface;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;
use Override;

final class TaxAuthorizationNodeMapper implements XmlNodeMapperInterface
{
    #[Override]
    public function map(ElectronicDocument $document): XmlElement
    {
        $node = XmlElement::make('gTimb');

        $node->addChild(
            XmlElement::make(
                'iTiDE',
                (string) $document->taxAuthorization()->documentType()->value
            )
        );

        $node->addChild(
            XmlElement::make(
                'dDesTiDE',
                $document->taxAuthorization()->documentType()->description()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dNumTim',
                $document->taxAuthorization()->number()->value()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dEst',
                $document->taxAuthorization()->establishment()->value()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dPunExp',
                $document->taxAuthorization()->expeditionPoint()->value()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dFeIniT',
                $document->taxAuthorization()->validFrom()->format('Y-m-d')
            )
        );

        return $node;
    }
}
