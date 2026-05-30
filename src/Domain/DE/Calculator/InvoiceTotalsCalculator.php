<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Calculator;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Money;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\ElectronicDocument;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Item;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Totals;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\VatTreatment;

final class InvoiceTotalsCalculator
{
    public function __construct(
        private ItemVatCalculator $vatCalculator,
    ) {}

    public function calculate(ElectronicDocument $document): Totals
    {
        $items = $document->items();
        if (count($items) === 0) {
            throw new \InvalidArgumentException(
                'Document must contain at least one item.'
            );
        }

        $exemptSubtotal = Money::zero('PYG');
        $exoneratedSubtotal = Money::zero('PYG');
        $taxableSubtotal5 = Money::zero('PYG');
        $taxableSubtotal10 = Money::zero('PYG');
        $vat5 = Money::zero('PYG');
        $vat10 = Money::zero('PYG');
        $totalOperation = Money::zero('PYG');

        /**
         * @var Item $item
         */
        foreach ($items as $item) {
            $itemTotal = $item->total();
            $vat = $item->vat();

            $totalOperation = $totalOperation->add($itemTotal);

            if ($vat->tratment() === VatTreatment::VAT_EXEMPT) {
                $exemptSubtotal = $exemptSubtotal->add($itemTotal);

                continue;
            }

            if ($vat->tratment() === VatTreatment::VAT_EXONERATED) {
                $exoneratedSubtotal = $exoneratedSubtotal->add($itemTotal);

                continue;
            }

            $taxableBase = $this
                ->vatCalculator
                ->taxableBase($item);

            $vatAmount = $this
                ->vatCalculator
                ->vatAmount($item);

            if ($vat->rate()->value() === 5) {
                $taxableSubtotal5 = $taxableSubtotal5->add($taxableBase);
                $vat5 = $vat5->add($vatAmount);
            }

            if ($vat->rate()->value() === 10) {
                $taxableSubtotal10 = $taxableSubtotal10->add($taxableBase);
                $vat10 = $vat10->add($vatAmount);
            }
        }

        $totalVat = Money::fromAmount(
            $vat5->add($vat10)->amount(),
            'PYG'
        );

        return new Totals(
            exemptSubtotal: $exemptSubtotal,
            exoneratedSubtotal: $exoneratedSubtotal,
            taxableSubtotal5: $taxableSubtotal5,
            taxableSubtotal10: $taxableSubtotal10,
            vat5: $vat5,
            vat10: $vat10,
            totalVat: $totalVat,
            totalOperation: $totalOperation,
        );
    }
}
