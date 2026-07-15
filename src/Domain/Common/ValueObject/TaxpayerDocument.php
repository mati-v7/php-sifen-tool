<?php

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Contracts\ReceiverDocument;

final readonly class TaxpayerDocument implements ReceiverDocument
{
    public function __construct(private Ruc $ruc)
    {
        //
    }

    public function ruc(): Ruc
    {
        return $this->ruc;
    }
}
