<?php

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\Catalog\Contracts\GeographicCatalog;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Receiver;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;

final readonly class ReceiverAddressNodeMapper
{
    public function map(
        XmlElement $parentNode,
        GeographicCatalog $catalog,
        Receiver $receiver
    ): void {
        if ($receiver->address() === null) {
            return;
        }

        if ($receiver->operation()->isForeign()) {
            $parentNode->addChild(
                XmlElement::make(
                    'dDirRec',
                    $receiver->address()->street()
                )
            );

            $parentNode->addChild(
                XmlElement::make(
                    'dNumCasRec',
                    $receiver->address()->houseNumber()
                )
            );

            return;
        }

        $parentNode->addChild(
            XmlElement::make(
                'dDirRec',
                $receiver->address()->street()
            )
        );

        $parentNode->addChild(
            XmlElement::make(
                'dNumCasRec',
                $receiver->address()->houseNumber()
            )
        );

        $location = $catalog->resolve($receiver->address()->city());

        $parentNode->addChild(
            XmlElement::make(
                'cDepRec',
                (string) $location->department()->code()
            )
        );

        $parentNode->addChild(
            XmlElement::make(
                'dDesDepRec',
                $location->department()->name()
            )
        );

        $parentNode->addChild(
            XmlElement::make(
                'cDisRec',
                (string) $location->district()->code()
            )
        );

        $parentNode->addChild(
            XmlElement::make(
                'dDesDisRec',
                $location->district()->name()
            )
        );

        $parentNode->addChild(
            XmlElement::make(
                'cCiuRec',
                (string) $location->city()->code()
            )
        );

        $parentNode->addChild(
            XmlElement::make(
                'dDesCiuRec',
                $location->city()->name()
            )
        );
    }
}
