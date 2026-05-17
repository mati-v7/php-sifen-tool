<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\ElectronicDocument;
use Nyxcode\PhpSifenTool\Domain\DE\Service\CDCGenerator;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\XmlNodeMapperInterface;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Namespace\SifenNamespaces;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;
use Override;

final class InvoiceNodeMapper implements XmlNodeMapperInterface
{
    #[Override]
    public function map(ElectronicDocument $document): XmlElement
    {
        $root = XmlElement::make('rDE')
            ->addAttribute(
                'xmlns',
                SifenNamespaces::SIFEN
            )
            ->addAttribute(
                'xmlns:xsi',
                SifenNamespaces::XSI
            )
            ->addAttribute(
                'xsi:schemaLocation',
                SifenNamespaces::SI_RECEPDE_V150
            );

        $root->addChild(
            XmlElement::make('dVerFor', '150')
        );

        $de = XmlElement::make('DE')
            ->addAttribute(
                'Id',
                (new CDCGenerator)->generate($document)->value()
            );

        $de->addChild(
            XmlElement::make(
                'dFecFirma',
                $document->issuedAt()->format('Y-m-d\TH:i:s')
            )
        );

        $de->addChild(
            (new OperationNodeMapper)
                ->map($document)
        );

        $de->addChild(
            (new TaxAuthorizationNodeMapper)
                ->map($document)
        );

        $de->addChild(
            (new GeneralOperationDataNodeMapper)
                ->map($document)
        );

        $de->addChildren(
            (new ItemNodeMapper)
                ->mapItems($document)
        );

        $de->addChild(
            (new TotalsNodeMapper)
                ->map($document)
        );

        $root->addChild($de);

        return $root;
    }
}
