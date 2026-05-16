<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\ElectronicDocument;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\XmlNodeMapperInterface;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;
use Override;

final class TotalsNodeMapper implements XmlNodeMapperInterface
{
    #[Override]
    public function map(object $document): XmlElement
    {
        if (! $document instanceof ElectronicDocument) {
            throw new \InvalidArgumentException;
        }

        $node = XmlElement::make('gTotSub');

        $node->addChild(
            XmlElement::make(
                'dTotGralOpe',
                $document->totals()->totalAmount()->amount()
            )
        );

        return $node;
    }
}
