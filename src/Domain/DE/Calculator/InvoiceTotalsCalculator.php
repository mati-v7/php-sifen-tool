<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Calculator;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Money;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\ElectronicDocument;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Item;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Totals;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\ElectronicDocumentType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\VatTreatment;

final class InvoiceTotalsCalculator
{
    public function __construct(
        private ItemVatCalculator $vatCalculator = new ItemVatCalculator,
        private ItemPricingCalculator $pricingCalculator = new ItemPricingCalculator,
    ) {}

    public function calculate(ElectronicDocument $document): Totals
    {
        $items = $document->items();
        if (count($items) === 0) {
            throw new \InvalidArgumentException(
                'Document must contain at least one item.'
            );
        }

        $isSelfBilledInvoice = $document->taxAuthorization()->documentType()
            === ElectronicDocumentType::ELECTRONIC_SELF_BILLED_INVOICE;

        $exemptSubtotal = Money::zero('PYG');
        $exoneratedSubtotal = Money::zero('PYG');
        $taxableSubtotal5 = Money::zero('PYG');
        $taxableSubtotal10 = Money::zero('PYG');
        $taxableBase5 = Money::zero('PYG');
        $taxableBase10 = Money::zero('PYG');
        $vat5 = Money::zero('PYG');
        $vat10 = Money::zero('PYG');
        $hasRate5 = false;
        $hasRate10 = false;

        $totalDiscount = Money::zero('PYG');
        $totalGlobalDiscountPerItem = Money::zero('PYG');
        $totalAdvancePaymentPerItem = Money::zero('PYG');
        $totalGlobalAdvancePaymentPerItem = Money::zero('PYG');

        /**
         * @var Item $item
         */
        foreach ($items as $item) {
            $itemNetTotal = $this->pricingCalculator->netTotal($item, $isSelfBilledInvoice);
            $vat = $item->vat();

            $totalDiscount = $totalDiscount->add($this->pricingCalculator->discount($item));
            $totalGlobalDiscountPerItem = $totalGlobalDiscountPerItem->add($this->pricingCalculator->globalDiscount($item));
            $totalAdvancePaymentPerItem = $totalAdvancePaymentPerItem->add($this->pricingCalculator->advancePayment($item));
            $totalGlobalAdvancePaymentPerItem = $totalGlobalAdvancePaymentPerItem->add($this->pricingCalculator->globalAdvancePayment($item));

            if ($vat->tratment() === VatTreatment::VAT_EXEMPT) {
                $exemptSubtotal = $exemptSubtotal->add($itemNetTotal);

                continue;
            }

            if ($vat->tratment() === VatTreatment::VAT_EXONERATED) {
                $exoneratedSubtotal = $exoneratedSubtotal->add($itemNetTotal);

                continue;
            }

            $taxableBase = $this->vatCalculator->taxableBase($item);
            $vatAmount = $this->vatCalculator->vatAmount($item);

            if ($vat->rate()->value() === 5) {
                $hasRate5 = true;
                $taxableSubtotal5 = $taxableSubtotal5->add($itemNetTotal);
                $taxableBase5 = $taxableBase5->add($taxableBase);
                $vat5 = $vat5->add($vatAmount);
            }

            if ($vat->rate()->value() === 10) {
                $hasRate10 = true;
                $taxableSubtotal10 = $taxableSubtotal10->add($itemNetTotal);
                $taxableBase10 = $taxableBase10->add($taxableBase);
                $vat10 = $vat10->add($vatAmount);
            }
        }

        $totalOperation = $exemptSubtotal
            ->add($exoneratedSubtotal)
            ->add($taxableSubtotal5)
            ->add($taxableSubtotal10);

        $rounding = $totalOperation->subtract(
            $totalOperation->floorToNearest(50)
        );

        $totalGeneral = $totalOperation->subtract($rounding);

        $roundingVat5 = $hasRate5 ? $rounding->divide('1.05') : null;
        $roundingVat10 = $hasRate10 ? $rounding->divide('1.1') : null;

        $totalVat = $vat5
            ->add($vat10)
            ->subtract($roundingVat5 ?? Money::zero('PYG'))
            ->subtract($roundingVat10 ?? Money::zero('PYG'));

        return new Totals(
            exemptSubtotal: $exemptSubtotal,
            exoneratedSubtotal: $exoneratedSubtotal,
            taxableSubtotal5: $taxableSubtotal5,
            taxableSubtotal10: $taxableSubtotal10,
            totalOperation: $totalOperation,
            totalDiscount: $totalDiscount,
            totalGlobalDiscountPerItem: $totalGlobalDiscountPerItem,
            totalAdvancePaymentPerItem: $totalAdvancePaymentPerItem,
            totalGlobalAdvancePaymentPerItem: $totalGlobalAdvancePaymentPerItem,
            totalDiscounts: $totalDiscount->add($totalGlobalDiscountPerItem),
            totalAdvancePayments: $totalAdvancePaymentPerItem->add($totalGlobalAdvancePaymentPerItem),
            rounding: $rounding,
            totalGeneral: $totalGeneral,
            vat5: $vat5,
            vat10: $vat10,
            roundingVat5: $roundingVat5,
            roundingVat10: $roundingVat10,
            totalVat: $totalVat,
            taxableBase5: $hasRate5 ? $taxableBase5 : null,
            taxableBase10: $hasRate10 ? $taxableBase10 : null,
            totalTaxableBase: ($hasRate5 || $hasRate10) ? $taxableBase5->add($taxableBase10) : null,
        );
    }
}
