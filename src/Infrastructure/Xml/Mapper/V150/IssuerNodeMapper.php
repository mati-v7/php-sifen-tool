<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\Invoice;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\XmlNodeMapperInterface;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;
use Override;

final class IssuerNodeMapper implements XmlNodeMapperInterface
{
    #[Override]
    public function map(object $document): XmlElement
    {
        if (! $document instanceof Invoice) {
            throw new \InvalidArgumentException;
        }

        $node = XmlElement::make('gEmis');

        $node->addChild(
            XmlElement::make(
                'dRucEm',
                $document->issuer()->ruc()->value()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dNomEmi',
                $document->issuer()->name()
            )
        );

        return $node;
    }
}
