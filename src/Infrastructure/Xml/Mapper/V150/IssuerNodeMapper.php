<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\Catalog\Contracts\GeographicCatalog;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\ElectronicDocument;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\XmlNodeMapperInterface;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;
use Override;

final class IssuerNodeMapper implements XmlNodeMapperInterface
{
    public function __construct(
        private GeographicCatalog $catalog,
    ) {}

    #[Override]
    public function map(object $document): XmlElement
    {
        if (! $document instanceof ElectronicDocument) {
            throw new \InvalidArgumentException;
        }

        $node = XmlElement::make('gEmis');
        $issuer = $document->issuer();
        $address = $issuer->address();

        $node->addChild(
            XmlElement::make(
                'dRucEm',
                $issuer->ruc()->value()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dDVEmi',
                (string) $issuer->ruc()->checkDigit()
            )
        );

        $node->addChild(
            XmlElement::make(
                'iTipCont',
                (string) $issuer->taxpayerType()->value
            )
        );

        if ($issuer->taxRegimeType()) {
            $node->addChild(
                XmlElement::make(
                    'cTipReg',
                    (string) $issuer->taxpayerType()->value
                )
            );
        }

        $node->addChild(
            XmlElement::make(
                'dNomEmi',
                $issuer->name()->value()
            )
        );

        if ($issuer->tradeName()) {
            $node->addChild(
                XmlElement::make(
                    'dNomFanEmi',
                    $issuer->tradeName()->value()
                )
            );
        }

        $node->addChild(
            XmlElement::make(
                'dDirEmi',
                $address->street()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dNumCas',
                (string) $address->houseNumber()
            )
        );

        if ($address->complement1()) {
            $node->addChild(
                XmlElement::make(
                    'dCompDir1',
                    $address->complement1()
                )
            );
        }

        if ($address->complement2()) {
            $node->addChild(
                XmlElement::make(
                    'dCompDir2',
                    $address->complement2()
                )
            );
        }

        $location = $this->catalog->resolve($address->city());

        $node->addChild(
            XmlElement::make(
                'cDepEmi',
                (string) $location->department()->code()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dDesDepEmi',
                $location->department()->name()
            )
        );

        $node->addChild(
            XmlElement::make(
                'cDisEmi',
                (string) $location->district()->code()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dDisEmi',
                $location->district()->name()
            )
        );

        $node->addChild(
            XmlElement::make(
                'cCiuEmi',
                (string) $location->city()->code()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dDesCiuEmi',
                $location->city()->name()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dTelEmi',
                $issuer->phoneNumber()->value()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dEmailE',
                $issuer->emailAddress()->value()
            )
        );

        if ($issuer->branchName()) {
            $node->addChild(
                XmlElement::make(
                    'dDenSuc',
                    $issuer->branchName()->value()
                )
            );
        }

        return $node;
    }
}
