<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\DEResponsible;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;

final readonly class DEResponsibleNodeMapper
{
    public function map(DEResponsible $responsible): XmlElement
    {
        $node = XmlElement::make('gRespDE');
        $document = $responsible->document();

        $node->addChild(
            XmlElement::make(
                'iTipIDRespDE',
                (string) $document->type()->value
            )
        );

        $node->addChild(
            XmlElement::make(
                'dDTipIDRespDE',
                $document->description()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dNumIDRespDE',
                $document->number()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dNomRespDE',
                $responsible->name()->value()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dCarRespDE',
                $responsible->position()->value()
            )
        );

        return $node;
    }
}
