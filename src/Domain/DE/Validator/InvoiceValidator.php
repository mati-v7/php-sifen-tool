<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Validator;

use Nyxcode\PhpSifenTool\Domain\Common\Exception\ValidationException;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\ElectronicDocument;
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
        }
    }
}
