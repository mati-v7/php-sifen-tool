<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Validator;

use Nyxcode\PhpSifenTool\Domain\Common\Exception\ValidationException;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\ElectronicDocument;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\OperationType;

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
    }
}
