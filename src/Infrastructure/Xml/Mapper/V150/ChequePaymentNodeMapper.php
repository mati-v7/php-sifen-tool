<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\ChequePayment;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;

final readonly class ChequePaymentNodeMapper
{
    public function map(ChequePayment $chequePayment): XmlElement
    {
        $node = XmlElement::make('gPagCheq');

        $node->addChild(
            XmlElement::make('dNumCheq', str_pad($chequePayment->number(), 8, '0', STR_PAD_LEFT))
        );

        $node->addChild(
            XmlElement::make('dBcoEmi', $chequePayment->issuingBank())
        );

        return $node;
    }
}
