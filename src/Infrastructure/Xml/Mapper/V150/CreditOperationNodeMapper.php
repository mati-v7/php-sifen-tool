<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\Catalog\Contracts\CurrencyCatalog;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\CreditOperation;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;

final readonly class CreditOperationNodeMapper
{
    public function __construct(
        private CurrencyCatalog $currencyCatalog,
    ) {}

    public function map(CreditOperation $creditOperation): XmlElement
    {
        $node = XmlElement::make('gPagCred');

        $node->addChild(
            XmlElement::make('iCondCred', (string) $creditOperation->conditionType()->value)
        );

        $node->addChild(
            XmlElement::make('dDCondCred', $creditOperation->conditionType()->description())
        );

        if ($creditOperation->term() !== null) {
            $node->addChild(
                XmlElement::make('dPlazoCre', $creditOperation->term())
            );
        }

        if ($creditOperation->installmentsCount() !== null) {
            $node->addChild(
                XmlElement::make('dCuotas', (string) $creditOperation->installmentsCount())
            );
        }

        if ($creditOperation->initialPayment() !== null) {
            $node->addChild(
                XmlElement::make('dMonEnt', $creditOperation->initialPayment()->amount())
            );
        }

        $node->addChildren(
            (new InstallmentNodeMapper($this->currencyCatalog))
                ->mapInstallments($creditOperation)
        );

        return $node;
    }
}
