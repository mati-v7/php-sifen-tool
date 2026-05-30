<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\ElectronicDocument;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Item;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;

final class ItemNodeMapper
{
    public function mapItems(ElectronicDocument $invoice): array
    {
        return array_map(
            fn(Item $item) => $this->map($item),
            $invoice->items()
        );
    }

    private function map(Item $item): XmlElement
    {
        $node = XmlElement::make('gCamItem');

        $node->addChild(
            XmlElement::make(
                'dDesProSer',
                $item->description()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dCantProSer',
                (string) $item->quantity()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dPUniProSer',
                $item->unitPrice()->amount()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dTotOpeItem',
                $item->total()->amount()
            )
        );

        $iva = XmlElement::make('gCamIVA');

        $iva->addChild(
            XmlElement::make(
                'dTasaIVA',
                (string) $item->vat()->rate()->value()
            )
        );

        $node->addChild($iva);

        return $node;
    }
}
