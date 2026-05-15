<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\Invoice;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\XmlNodeMapperInterface;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\XmlWriterInterface;
use Override;

final class TotalsNodeMapper implements XmlNodeMapperInterface
{
    public function __construct(
        private XmlWriterInterface $writer,
    ) {}

    #[Override]
    public function map(object $document): void
    {
        if (! $document instanceof Invoice) {
            throw new \InvalidArgumentException;
        }

        $this->writer->appendNode(
            'DE',
            'gTotSub'
        );

        $this->writer->appendNode(
            'gTotSub',
            'dTotGralOpe',
            $document->total()->amount()
        );
    }
}
