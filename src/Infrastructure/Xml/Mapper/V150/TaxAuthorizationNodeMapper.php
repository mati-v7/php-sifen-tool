<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\TaxAuthorization;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\XmlNodeMapperInterface;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;
use Override;

final class TaxAuthorizationNodeMapper implements XmlNodeMapperInterface
{
    #[Override]
    public static function supports(): string
    {
        return TaxAuthorization::class;
    }

    public function map(TaxAuthorization $taxAuthorization): XmlElement
    {
        $node = XmlElement::make('gTimb');

        $node->addChild(
            XmlElement::make(
                'iTiDE',
                (string) $taxAuthorization->documentType()->value
            )
        );

        $node->addChild(
            XmlElement::make(
                'dDesTiDE',
                $taxAuthorization->documentType()->description()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dNumTim',
                $taxAuthorization->number()->value()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dEst',
                $taxAuthorization->establishment()->value()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dPunExp',
                $taxAuthorization->expeditionPoint()->value()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dNumDoc',
                $taxAuthorization->documentNumber()->value()
            )
        );

        if ($taxAuthorization->serie()) {
            $node->addChild(
                XmlElement::make(
                    'dSerieNum',
                    $taxAuthorization->serie()->value()
                )
            );
        }

        $node->addChild(
            XmlElement::make(
                'dFeIniT',
                $taxAuthorization->validFrom()->format('Y-m-d')
            )
        );

        return $node;
    }
}
