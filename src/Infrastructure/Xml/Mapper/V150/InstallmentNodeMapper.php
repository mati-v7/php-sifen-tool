<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\Catalog\Contracts\CurrencyCatalog;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\CurrencyCode;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\CreditOperation;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Installment;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;

final readonly class InstallmentNodeMapper
{
    public function __construct(
        private CurrencyCatalog $currencyCatalog,
    ) {}

    /**
     * @return XmlElement[]
     */
    public function mapInstallments(CreditOperation $creditOperation): array
    {
        return array_map(
            fn (Installment $installment) => $this->map($installment),
            $creditOperation->installments()
        );
    }

    private function map(Installment $installment): XmlElement
    {
        $node = XmlElement::make('gCuotas');

        $currencyCode = new CurrencyCode($installment->amount()->currency());

        $node->addChild(
            XmlElement::make('cMoneCuo', $currencyCode->value())
        );

        $node->addChild(
            XmlElement::make(
                'dDMoneCuo',
                $this->currencyCatalog->resolve($currencyCode)->description()
            )
        );

        $node->addChild(
            XmlElement::make('dMonCuota', $installment->amount()->amount())
        );

        if ($installment->dueDate() !== null) {
            $node->addChild(
                XmlElement::make('dVencCuo', $installment->dueDate()->format('Y-m-d'))
            );
        }

        return $node;
    }
}
