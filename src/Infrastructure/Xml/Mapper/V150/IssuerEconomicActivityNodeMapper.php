<?php

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\EconomicActivity;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\ElectronicDocument;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;

final class IssuerEconomicActivityNodeMapper
{
    public function mapItems(ElectronicDocument $document): array
    {
        $issuer = $document->issuer();
        $activities = [];
        foreach ($issuer->activities() as $activity) {
            $activities[] = $this->map($activity);
        }

        return $activities;
    }

    public function map(EconomicActivity $activity): XmlElement
    {
        $node = XmlElement::make('gActEco');

        $node->addChild(
            XmlElement::make(
                'cActEco',
                $activity->code()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dDesActEco',
                $activity->description()
            )
        );

        return $node;
    }
}
