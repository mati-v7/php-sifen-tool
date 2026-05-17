<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\ElectronicDocument;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\XmlNodeMapperInterface;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;
use Override;

final class OperationNodeMapper implements XmlNodeMapperInterface
{
    #[Override]
    public function map(ElectronicDocument $document): XmlElement
    {
        $node = XmlElement::make('gOpeDE');

        $node->addChild(
            XmlElement::make(
                'iTipEmi',
                (string) $document->operation()->emissionType()->value
            )
        );

        $node->addChild(
            XmlElement::make(
                'dDesTipEmi',
                $document->operation()->emissionType()->description()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dCodSeg',
                $document->operation()->securityCode()->value()
            )
        );

        return $node;
    }
}
