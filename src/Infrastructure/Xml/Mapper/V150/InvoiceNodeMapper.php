<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\XmlNodeMapperInterface;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\XmlWriterInterface;
use Override;

final class InvoiceNodeMapper implements XmlNodeMapperInterface
{
    public function __construct(
        private readonly XmlWriterInterface $writer,
    ) {}

    #[Override]
    public function map(object $document): void
    {
        $this->writer->appendNode(
            'rDE',
            'dVerFor',
            '150'
        );

        $this->writer->appendNode(
            'rDE',
            'DE'
        );

        (new IssuerNodeMapper($this->writer))
            ->map($document);

        (new ReceiverNodeMapper($this->writer))
            ->map($document);

        (new ItemNodeMapper($this->writer))
            ->map($document);

        (new TotalsNodeMapper($this->writer))
            ->map($document);
    }
}
