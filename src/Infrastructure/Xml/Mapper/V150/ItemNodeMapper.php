<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\Catalog\Contracts\CountryCatalog;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\ElectronicDocument;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Item;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;

final readonly class ItemNodeMapper
{
    public function __construct(
        private CountryCatalog $countryCatalog,
    ) {}

    public function mapItems(ElectronicDocument $invoice): array
    {
        return array_map(
            fn (Item $item) => $this->map($item),
            $invoice->items()
        );
    }

    private function map(Item $item): XmlElement
    {
        $node = XmlElement::make('gCamItem');

        $node->addChild(
            XmlElement::make('dCodInt', $item->internalCode())
        );

        if ($item->tariffPosition() !== null) {
            $node->addChild(
                XmlElement::make('dParAranc', $item->tariffPosition())
            );
        }

        if ($item->ncm() !== null) {
            $node->addChild(
                XmlElement::make('dNCM', $item->ncm())
            );
        }

        if ($item->dncpGeneralCode() !== null) {
            $node->addChild(
                XmlElement::make('dDncpG', $item->dncpGeneralCode())
            );
        }

        if ($item->dncpSpecificCode() !== null) {
            $node->addChild(
                XmlElement::make('dDncpE', $item->dncpSpecificCode())
            );
        }

        if ($item->gtin() !== null) {
            $node->addChild(
                XmlElement::make('dGtin', $item->gtin())
            );
        }

        if ($item->gtinPackage() !== null) {
            $node->addChild(
                XmlElement::make('dGtinPq', $item->gtinPackage())
            );
        }

        $node->addChild(
            XmlElement::make(
                'dDesProSer',
                $item->description()
            )
        );

        $node->addChild(
            XmlElement::make('cUniMed', (string) $item->unitOfMeasureCode())
        );

        $node->addChild(
            XmlElement::make('dDesUniMed', $item->unitOfMeasureDescription())
        );

        $node->addChild(
            XmlElement::make(
                'dCantProSer',
                (string) $item->quantity()
            )
        );

        if ($item->originCountry() !== null) {
            $country = $this->countryCatalog->resolve($item->originCountry());

            $node->addChild(
                XmlElement::make('cPaisOrig', $country->code())
            );

            $node->addChild(
                XmlElement::make('dDesPaisOrig', $country->name())
            );
        }

        if ($item->additionalInfo() !== null) {
            $node->addChild(
                XmlElement::make('dInfItem', $item->additionalInfo())
            );
        }

        if ($item->relevantMerchandiseData() !== null) {
            $node->addChild(
                XmlElement::make('cRelMerc', (string) $item->relevantMerchandiseData()->value)
            );

            $node->addChild(
                XmlElement::make('dDesRelMerc', $item->relevantMerchandiseData()->description())
            );
        }

        if ($item->breakageOrShrinkageQuantity() !== null) {
            $node->addChild(
                XmlElement::make('dCanQuiMer', (string) $item->breakageOrShrinkageQuantity())
            );
        }

        if ($item->breakageOrShrinkagePercentage() !== null) {
            $node->addChild(
                XmlElement::make('dPorQuiMer', (string) $item->breakageOrShrinkagePercentage())
            );
        }

        if ($item->advancePaymentCDC() !== null) {
            $node->addChild(
                XmlElement::make('dCDCAnticipo', $item->advancePaymentCDC()->value())
            );
        }

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
