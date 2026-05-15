<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\XmlNodeMapperInterface;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Namespace\SifenNamespaces;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;
use Override;

final class InvoiceNodeMapper implements XmlNodeMapperInterface
{
    #[Override]
    public function map(object $document): XmlElement
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

        $de = XmlElement::make('DE');

        $de->addChild(
            (new IssuerNodeMapper)
                ->map($document)
        );

        $de->addChild(
            (new ReceiverNodeMapper)
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
