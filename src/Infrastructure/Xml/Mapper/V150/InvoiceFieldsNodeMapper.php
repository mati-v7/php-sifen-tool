<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\InvoiceData;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;

final readonly class InvoiceFieldsNodeMapper
{
    public function map(InvoiceData $invoiceData): XmlElement
    {
        $node = XmlElement::make('gCamFE');

        $node->addChild(
            XmlElement::make(
                'iIndPres',
                (string) $invoiceData->presenceIndicator()->value
            )
        );

        $node->addChild(
            XmlElement::make(
                'dDesIndPres',
                $invoiceData->presenceIndicatorDescription()
            )
        );

        if ($invoiceData->futureDeliveryDate()) {
            $node->addChild(
                XmlElement::make(
                    'dFecEmNR',
                    $invoiceData->futureDeliveryDate()->format('Y-m-d')
                )
            );
        }

        return $node;
    }
}
