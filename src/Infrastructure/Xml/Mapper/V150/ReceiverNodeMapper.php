<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\Invoice;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\XmlNodeMapperInterface;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\XmlWriterInterface;
use Override;

final class ReceiverNodeMapper implements XmlNodeMapperInterface
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

        $this->writer->appendNode(
            'DE',
            'gDatRec'
        );

        $this->writer->appendNode(
            'gDatRec',
            'dNumIDRec',
            $document->receiver()->documentNumber()
        );

        $this->writer->appendNode(
            'gDatRec',
            'dNomRec',
            $document->receiver()->name()
        );
    }
}
