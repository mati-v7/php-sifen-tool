<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Validator;

use Nyxcode\PhpSifenTool\Domain\Common\Exception\ValidationException;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\ElectronicDocument;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\CardBrand;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\CreditConditionType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\OperationConditionType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\OperationType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\PaymentType;

final class InvoiceValidator
{
    public function validate(ElectronicDocument $invoice): void
    {
        if (count($invoice->items()) === 0) {
            throw new ValidationException(
                'Invoice must contain at least one item.'
            );
        }

        foreach ($invoice->items() as $item) {
            if ($item->quantity() <= 0) {
                throw new ValidationException(
                    'Item quantity must be greater than zero.'
                );
            }

            if ($item->unitPrice()->isNegative()) {
                throw new ValidationException(
                    'Item price cannot be negative.'
                );
            }
        }

        $publicProcurement = $invoice->invoiceData()->publicProcurement();

        if ($invoice->receiver()->operation() === OperationType::B2G && $publicProcurement === null) {
            throw new ValidationException(
                'Public procurement data (gCompPub) is required when the receiver operation type is B2G.'
            );
        }

        if ($publicProcurement !== null && $publicProcurement->codeIssuedAt() >= $invoice->issuedAt()) {
            throw new ValidationException(
                'The public procurement code issuance date must be earlier than the invoice issue date.'
            );
        }

        $paymentCondition = $invoice->paymentCondition();

        if ($paymentCondition->conditionType() === OperationConditionType::CASH
            && count($paymentCondition->cashPayments()) === 0) {
            throw new ValidationException(
                'At least one cash payment (gPaConEIni) is required when the operation condition is cash (E601 = 1).'
            );
        }

        foreach ($paymentCondition->cashPayments() as $cashPayment) {
            if ($cashPayment->type() === PaymentType::OTHER && $cashPayment->customDescription() === null) {
                throw new ValidationException(
                    'A custom payment type description (dDesTiPag) is required when the payment type is "Otro" (iTiPago = 99).'
                );
            }

            if ($cashPayment->amount()->currency() !== 'PYG' && $cashPayment->exchangeRate() === null) {
                throw new ValidationException(
                    'The exchange rate (dTiCamTiPag) is required when the cash payment currency is not PYG.'
                );
            }

            $isCardPaymentType = in_array(
                $cashPayment->type(),
                [PaymentType::CREDIT_CARD, PaymentType::DEBIT_CARD],
                true
            );

            if ($isCardPaymentType && $cashPayment->cardPayment() === null) {
                throw new ValidationException(
                    'Card payment data (gPagTarCD) is required when the payment type is credit or debit card (iTiPago = 3 or 4).'
                );
            }

            if (! $isCardPaymentType && $cashPayment->cardPayment() !== null) {
                throw new ValidationException(
                    'Card payment data (gPagTarCD) can only be informed when the payment type is credit or debit card (iTiPago = 3 or 4).'
                );
            }

            if ($cashPayment->cardPayment() !== null
                && $cashPayment->cardPayment()->brand() === CardBrand::OTHER
                && $cashPayment->cardPayment()->customBrandDescription() === null) {
                throw new ValidationException(
                    'A custom card brand description (dDesDenTarj) is required when the card denomination is "Otro" (iDenTarj = 99).'
                );
            }

            $isChequePaymentType = $cashPayment->type() === PaymentType::CHECK;

            if ($isChequePaymentType && $cashPayment->chequePayment() === null) {
                throw new ValidationException(
                    'Cheque payment data (gPagCheq) is required when the payment type is cheque (iTiPago = 2).'
                );
            }

            if (! $isChequePaymentType && $cashPayment->chequePayment() !== null) {
                throw new ValidationException(
                    'Cheque payment data (gPagCheq) can only be informed when the payment type is cheque (iTiPago = 2).'
                );
            }
        }

        $creditOperation = $paymentCondition->creditOperation();

        if ($paymentCondition->conditionType() === OperationConditionType::CREDIT && $creditOperation === null) {
            throw new ValidationException(
                'Credit operation data (gPagCred) is required when the operation condition is credit (E601 = 2).'
            );
        }

        if ($paymentCondition->conditionType() !== OperationConditionType::CREDIT && $creditOperation !== null) {
            throw new ValidationException(
                'Credit operation data (gPagCred) can only be informed when the operation condition is credit (E601 = 2).'
            );
        }

        if ($creditOperation !== null) {
            if ($creditOperation->conditionType() === CreditConditionType::TERM && $creditOperation->term() === null) {
                throw new ValidationException(
                    'Credit term (dPlazoCre) is required when the credit condition is term (iCondCred = 1).'
                );
            }

            if ($creditOperation->conditionType() === CreditConditionType::INSTALLMENT
                && $creditOperation->installmentsCount() === null) {
                throw new ValidationException(
                    'Installments count (dCuotas) is required when the credit condition is installment (iCondCred = 2).'
                );
            }

            if ($creditOperation->conditionType() !== CreditConditionType::INSTALLMENT
                && count($creditOperation->installments()) > 0) {
                throw new ValidationException(
                    'Installments (gCuotas) can only be informed when the credit condition is installment (iCondCred = 2).'
                );
            }
        }
    }
}
