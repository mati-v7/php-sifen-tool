<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\Catalog\Contracts\CountryCatalog;
use Nyxcode\PhpSifenTool\Domain\Catalog\Contracts\GeographicCatalog;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Receiver;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\XmlNodeMapperInterface;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150\Composite\CompositeReceiverDocumentNodeMapper;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;
use Override;

final class ReceiverNodeMapper implements XmlNodeMapperInterface
{
    public function __construct(
        private CountryCatalog $countryCatalog,
        private GeographicCatalog $geographicCatalog,
        private CompositeReceiverDocumentNodeMapper $compositeReceiverDocument,
        private ReceiverAddressNodeMapper $addressNodeMapper,
        private ReceiverContactNodeMapper $contactNodeMapper,
    ) {
        //
    }

    #[Override]
    public static function supports(): string
    {
        return Receiver::class;
    }

    public function map(Receiver $receiver): XmlElement
    {

        $node = XmlElement::make('gDatRec');

        $node->addChild(
            XmlElement::make(
                'iNatRec',
                (string) $receiver->nature()->value
            )
        );

        $node->addChild(
            XmlElement::make(
                'iTiOpe',
                (string) $receiver->operation()->value
            )
        );

        $country = $this->countryCatalog->resolve(
            $receiver->country()
        );

        $node->addChild(
            XmlElement::make(
                'cPaisRec',
                $country->code()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dDesPaisRe',
                $country->name()
            )
        );

        if ($receiver->nature()->isTaxpayer()) {
            $node->addChild(
                XmlElement::make(
                    'iTiContRec',
                    (string) $receiver->document()->taxpayerType()->value
                )
            );
        }

        $this->compositeReceiverDocument->map(
            $node,
            $receiver
        );

        if ($receiver->fantasyName() !== null) {
            $node->addChild(
                XmlElement::make(
                    'dNomFanRec',
                    $receiver->fantasyName()
                )
            );
        }

        $this->addressNodeMapper->map(
            $node,
            $this->geographicCatalog,
            $receiver
        );

        $this->contactNodeMapper->map(
            $node,
            $receiver
        );

        if ($receiver->customerCode() !== null) {
            $node->addChild(
                XmlElement::make(
                    'dCodCliente',
                    $receiver->customerCode()->value()
                )
            );
        }

        return $node;
    }
}
