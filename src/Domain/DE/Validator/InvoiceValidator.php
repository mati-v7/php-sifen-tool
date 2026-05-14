<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Validator;

use Nyxcode\PhpSifenTool\Domain\Common\Exception\ValidationException;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Invoice;

final class InvoiceValidator
{
    public function validate(Invoice $invoice): void
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
    }
}
