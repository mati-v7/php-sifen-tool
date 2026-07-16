<?php

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\Receiver;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;

final readonly class ReceiverContactNodeMapper
{
    public function map(
        XmlElement $parentNode,
        Receiver $receiver
    ): void {

        if ($receiver->phone() !== null) {
            $parentNode->addChild(
                XmlElement::make(
                    'dTelRec',
                    $receiver->phone()->value()
                )
            );
        }

        if ($receiver->cellphone() !== null) {
            $parentNode->addChild(
                XmlElement::make(
                    'dCelRec',
                    $receiver->phone()->value()
                )
            );
        }

        if ($receiver->email() !== null) {
            $parentNode->addChild(
                XmlElement::make(
                    'dEmailRec',
                    $receiver->email()->value()
                )
            );
        }
    }
}
