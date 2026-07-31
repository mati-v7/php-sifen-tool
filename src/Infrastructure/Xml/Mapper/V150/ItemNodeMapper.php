<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\Catalog\Contracts\CountryCatalog;
use Nyxcode\PhpSifenTool\Domain\Catalog\Contracts\UnitOfMeasureCatalog;
use Nyxcode\PhpSifenTool\Domain\DE\Calculator\ItemPricingCalculator;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\ElectronicDocument;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Item;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\ElectronicDocumentType;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;

final readonly class ItemNodeMapper
{
    public function __construct(
        private CountryCatalog $countryCatalog,
        private UnitOfMeasureCatalog $unitOfMeasureCatalog,
        private ItemPricingCalculator $pricingCalculator = new ItemPricingCalculator,
    ) {}

    public function mapItems(ElectronicDocument $invoice): array
    {
        $isSelfBilledInvoice = $invoice->taxAuthorization()->documentType()
            === ElectronicDocumentType::ELECTRONIC_SELF_BILLED_INVOICE;

        return array_map(
            fn (Item $item) => $this->map($item, $isSelfBilledInvoice),
            $invoice->items()
        );
    }

    private function map(Item $item, bool $isSelfBilledInvoice): XmlElement
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

        $unitOfMeasure = $this->unitOfMeasureCatalog->resolve($item->unitOfMeasureCode());

        $node->addChild(
            XmlElement::make('cUniMed', (string) $unitOfMeasure->code())
        );

        $node->addChild(
            XmlElement::make('dDesUniMed', $unitOfMeasure->representation())
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

        $node->addChild($this->mapValorItem($item, $isSelfBilledInvoice));

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

    private function mapValorItem(Item $item, bool $isSelfBilledInvoice): XmlElement
    {
        $valorItem = XmlElement::make('gValorItem');

        $valorItem->addChild(
            XmlElement::make('dPUniProSer', $item->unitPrice()->amount())
        );

        if ($item->exchangeRate() !== null) {
            $valorItem->addChild(
                XmlElement::make('dTiCamIt', (string) $item->exchangeRate())
            );
        }

        $valorItem->addChild(
            XmlElement::make(
                'dTotBruOpeItem',
                $this->pricingCalculator->grossTotal($item)->amount()
            )
        );

        $valorItem->addChild($this->mapValorRestaItem($item, $isSelfBilledInvoice));

        return $valorItem;
    }

    private function mapValorRestaItem(Item $item, bool $isSelfBilledInvoice): XmlElement
    {
        $valorRestaItem = XmlElement::make('gValorRestaItem');

        $valorRestaItem->addChild(
            XmlElement::make(
                'dDescItem',
                $this->pricingCalculator->discount($item)->amount()
            )
        );

        $discountPercentage = $this->pricingCalculator->discountPercentage($item);

        if ($discountPercentage !== null) {
            $valorRestaItem->addChild(
                XmlElement::make('dPorcDesIt', $discountPercentage)
            );
        }

        if ($item->globalDiscount() !== null) {
            $valorRestaItem->addChild(
                XmlElement::make(
                    'dDescGloItem',
                    $this->pricingCalculator->globalDiscount($item)->amount()
                )
            );
        }

        $valorRestaItem->addChild(
            XmlElement::make(
                'dAntPreUniIt',
                $this->pricingCalculator->advancePayment($item)->amount()
            )
        );

        $valorRestaItem->addChild(
            XmlElement::make(
                'dAntGloPreUniIt',
                $this->pricingCalculator->globalAdvancePayment($item)->amount()
            )
        );

        $valorRestaItem->addChild(
            XmlElement::make(
                'dTotOpeItem',
                $this->pricingCalculator->netTotal($item, $isSelfBilledInvoice)->amount()
            )
        );

        $totalInGuaranies = $this->pricingCalculator->netTotalInGuaranies($item, $isSelfBilledInvoice);

        if ($totalInGuaranies !== null) {
            $valorRestaItem->addChild(
                XmlElement::make('dTotOpeGs', $totalInGuaranies->amount())
            );
        }

        return $valorRestaItem;
    }
}
