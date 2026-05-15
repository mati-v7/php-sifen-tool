<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\Invoice;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Item;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\XmlNodeMapperInterface;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\XmlWriterInterface;
use Override;

final class ItemNodeMapper implements XmlNodeMapperInterface
{
    public function __construct(
        private readonly XmlWriterInterface $writer,
    ) {}

    #[Override]
    public function map(object $document): void
    {
        if (! $document instanceof Invoice) {
            throw new \InvalidArgumentException;
        }

        foreach ($document->items() as $item) {
            $this->mapItem($item);
        }
    }

    private function mapItem(Item $item): void
    {
        $this->writer->appendNode(
            'DE',
            'gCamItem'
        );

        $this->writer->appendNode(
            'gCamItem',
            'dDesProSer',
            $item->description()
        );

        $this->writer->appendNode(
            'gCamItem',
            'dCantProSer',
            (string) $item->quantity()
        );

        $this->writer->appendNode(
            'gCamItem',
            'dPUniProSer',
            $item->unitPrice()->amount()
        );

        $this->writer->appendNode(
            'gCamItem',
            'dTotOpeItem',
            $item->total()->amount()
        );

        $this->writer->appendNode(
            'gCamItem',
            'gCamIVA'
        );

        $this->writer->appendNode(
            'gCamIVA',
            'dTasaIVA',
            (string) $item->vatPercentage()->value()
        );
    }
}
