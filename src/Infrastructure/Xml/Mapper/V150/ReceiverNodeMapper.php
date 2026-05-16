<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\ElectronicDocument;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\XmlNodeMapperInterface;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;
use Override;

final class ReceiverNodeMapper implements XmlNodeMapperInterface
{
    #[Override]
    public function map(object $document): XmlElement
    {
        if (! $document instanceof ElectronicDocument) {
            throw new \InvalidArgumentException;
        }

        $node = XmlElement::make('gDatRec');

        $node->addChild(
            XmlElement::make(
                'dNumIDRec',
                $document->receiver()->documentNumber()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dNomRec',
                $document->receiver()->name()
            )
        );

        return $node;
    }
}
