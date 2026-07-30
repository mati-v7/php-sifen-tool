<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\Catalog\Contracts\CurrencyCatalog;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\CurrencyCode;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\CashPayment;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\PaymentCondition;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;

final readonly class CashPaymentNodeMapper
{
    public function __construct(
        private CurrencyCatalog $currencyCatalog,
    ) {}

    /**
     * @return XmlElement[]
     */
    public function mapCashPayments(PaymentCondition $paymentCondition): array
    {
        return array_map(
            fn (CashPayment $cashPayment) => $this->map($cashPayment),
            $paymentCondition->cashPayments()
        );
    }

    private function map(CashPayment $cashPayment): XmlElement
    {
        $node = XmlElement::make('gPaConEIni');

        $node->addChild(
            XmlElement::make('iTiPago', (string) $cashPayment->type()->value)
        );

        $node->addChild(
            XmlElement::make('dDesTiPag', $cashPayment->description())
        );

        $node->addChild(
            XmlElement::make('dMonTiPag', $cashPayment->amount()->amount())
        );

        $currencyCode = new CurrencyCode($cashPayment->amount()->currency());

        $node->addChild(
            XmlElement::make('cMoneTiPag', $currencyCode->value())
        );

        $node->addChild(
            XmlElement::make(
                'dDMoneTiPag',
                $this->currencyCatalog->resolve($currencyCode)->description()
            )
        );

        if ($cashPayment->exchangeRate() !== null) {
            $node->addChild(
                XmlElement::make('dTiCamTiPag', $cashPayment->exchangeRate())
            );
        }

        if ($cashPayment->cardPayment() !== null) {
            $node->addChild(
                (new CardPaymentNodeMapper)->map($cashPayment->cardPayment())
            );
        }

        if ($cashPayment->chequePayment() !== null) {
            $node->addChild(
                (new ChequePaymentNodeMapper)->map($cashPayment->chequePayment())
            );
        }

        return $node;
    }
}
