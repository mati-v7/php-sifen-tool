<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\ElectronicDocument;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\XmlNodeMapperInterface;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;
use Override;

final class TotalsNodeMapper implements XmlNodeMapperInterface
{
    #[Override]
    public static function supports(): string
    {
        return ElectronicDocument::class;
    }

    public function map(ElectronicDocument $document): XmlElement
    {
        $totals = $document->totals();
        $node = XmlElement::make('gTotSub');

        $node->addChild(
            XmlElement::make('dSubExe', $totals->exemptSubtotal()->amount())
        );

        $node->addChild(
            XmlElement::make('dSubExo', $totals->exoneratedSubtotal()->amount())
        );

        $node->addChild(
            XmlElement::make('dSub5', $totals->taxableSubtotal5()->amount())
        );

        $node->addChild(
            XmlElement::make('dSub10', $totals->taxableSubtotal10()->amount())
        );

        $node->addChild(
            XmlElement::make('dTotOpe', $totals->totalOperation()->amount())
        );

        $node->addChild(
            XmlElement::make('dTotDesc', $totals->totalDiscount()->amount())
        );

        $node->addChild(
            XmlElement::make('dTotDescGlotem', $totals->totalGlobalDiscountPerItem()->amount())
        );

        $node->addChild(
            XmlElement::make('dTotAntItem', $totals->totalAdvancePaymentPerItem()->amount())
        );

        $node->addChild(
            XmlElement::make('dTotAnt', $totals->totalGlobalAdvancePaymentPerItem()->amount())
        );

        $node->addChild(
            XmlElement::make('dPorcDescTotal', '0')
        );

        $node->addChild(
            XmlElement::make('dDescTotal', $totals->totalDiscounts()->amount())
        );

        $node->addChild(
            XmlElement::make('dAnticipo', $totals->totalAdvancePayments()->amount())
        );

        $node->addChild(
            XmlElement::make('dRedon', $totals->rounding()->amount())
        );

        $node->addChild(
            XmlElement::make('dTotGralOpe', $totals->totalGeneral()->amount())
        );

        $node->addChild(
            XmlElement::make('dIVA5', $totals->vat5()->amount())
        );

        $node->addChild(
            XmlElement::make('dIVA10', $totals->vat10()->amount())
        );

        if ($totals->roundingVat5() !== null) {
            $node->addChild(
                XmlElement::make('dLiqTotIVA5', $totals->roundingVat5()->amount())
            );
        }

        if ($totals->roundingVat10() !== null) {
            $node->addChild(
                XmlElement::make('dLiqTotIVA10', $totals->roundingVat10()->amount())
            );
        }

        $node->addChild(
            XmlElement::make('dTotIVA', $totals->totalVat()->amount())
        );

        if ($totals->taxableBase5() !== null) {
            $node->addChild(
                XmlElement::make('dBaseGrav5', $totals->taxableBase5()->amount())
            );
        }

        if ($totals->taxableBase10() !== null) {
            $node->addChild(
                XmlElement::make('dBaseGrav10', $totals->taxableBase10()->amount())
            );
        }

        if ($totals->totalTaxableBase() !== null) {
            $node->addChild(
                XmlElement::make('dTBasGraIVA', $totals->totalTaxableBase()->amount())
            );
        }

        return $node;
    }
}
