<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\InvoiceData;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\PublicProcurement;
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

        if ($invoiceData->publicProcurement()) {
            $node->addChild(
                $this->mapPublicProcurement($invoiceData->publicProcurement())
            );
        }

        return $node;
    }

    private function mapPublicProcurement(PublicProcurement $publicProcurement): XmlElement
    {
        $node = XmlElement::make('gCompPub');

        $node->addChild(
            XmlElement::make('dModCont', $publicProcurement->modality()->value())
        );

        $node->addChild(
            XmlElement::make('dEntCont', $publicProcurement->entity()->value())
        );

        $node->addChild(
            XmlElement::make('dAnoCont', $publicProcurement->year()->value())
        );

        $node->addChild(
            XmlElement::make('dSecCont', $publicProcurement->sequence()->value())
        );

        $node->addChild(
            XmlElement::make('dFeCodCont', $publicProcurement->codeIssuedAt()->format('Y-m-d'))
        );

        return $node;
    }
}
