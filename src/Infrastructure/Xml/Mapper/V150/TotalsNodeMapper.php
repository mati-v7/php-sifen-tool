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
            XmlElement::make(
                'dSubExe',
                $totals->exemptSubtotal()->amount()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dSubExo',
                $totals->exoneratedSubtotal()->amount()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dSub5',
                $totals->taxableSubtotal5()->amount()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dSub10',
                $totals->taxableSubtotal10()->amount()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dIVA5',
                $totals->vat5()->amount()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dIVA10',
                $totals->vat10()->amount()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dTotIVA',
                $totals->totalVat()->amount()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dTotGralOpe',
                $totals->totalOperation()->amount()
            )
        );

        return $node;
    }
}
