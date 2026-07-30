<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\CardPayment;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;

final readonly class CardPaymentNodeMapper
{
    public function map(CardPayment $cardPayment): XmlElement
    {
        $node = XmlElement::make('gPagTarCD');

        $node->addChild(
            XmlElement::make('iDenTarj', (string) $cardPayment->brand()->value)
        );

        $node->addChild(
            XmlElement::make('dDesDenTarj', $cardPayment->brandDescription())
        );

        if ($cardPayment->processorBusinessName() !== null) {
            $node->addChild(
                XmlElement::make('dRSProTar', $cardPayment->processorBusinessName())
            );
        }

        if ($cardPayment->processorRuc() !== null) {
            $node->addChild(
                XmlElement::make('dRUCProTar', $cardPayment->processorRuc()->value())
            );

            $node->addChild(
                XmlElement::make('dDVProTar', (string) $cardPayment->processorRuc()->checkDigit())
            );
        }

        $node->addChild(
            XmlElement::make('iForProPa', (string) $cardPayment->processingType()->value)
        );

        if ($cardPayment->authorizationCode() !== null) {
            $node->addChild(
                XmlElement::make('dCodAuOpe', $cardPayment->authorizationCode())
            );
        }

        if ($cardPayment->holderName() !== null) {
            $node->addChild(
                XmlElement::make('dNomTit', $cardPayment->holderName())
            );
        }

        if ($cardPayment->cardNumber() !== null) {
            $node->addChild(
                XmlElement::make('dNumTarj', $cardPayment->cardNumber())
            );
        }

        return $node;
    }
}
