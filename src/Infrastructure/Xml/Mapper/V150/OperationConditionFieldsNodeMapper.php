<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\PaymentCondition;
use Nyxcode\PhpSifenTool\Infrastructure\Catalog\Currency\JsonCurrencyCatalog;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;

final readonly class OperationConditionFieldsNodeMapper
{
    public function map(PaymentCondition $paymentCondition): XmlElement
    {
        $node = XmlElement::make('gCamCond');

        $node->addChild(
            XmlElement::make(
                'iCondOpe',
                (string) $paymentCondition->conditionType()->value
            )
        );

        $node->addChild(
            XmlElement::make(
                'dDCondOpe',
                $paymentCondition->conditionType()->description()
            )
        );

        $catalogDirectory = dirname(__DIR__, 4).'/Resources/catalog';

        $node->addChildren(
            (new CashPaymentNodeMapper(new JsonCurrencyCatalog($catalogDirectory)))
                ->mapCashPayments($paymentCondition)
        );

        return $node;
    }
}
