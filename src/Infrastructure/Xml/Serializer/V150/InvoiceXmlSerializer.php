<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Serializer\V150;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\Invoice;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\XmlSerializerInterface;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150\InvoiceNodeMapper;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Writer\DomXmlWriter;
use Override;

final class InvoiceXmlSerializer implements XmlSerializerInterface
{
    #[Override]
    public function serialize(object $document): string
    {
        if (! $document instanceof Invoice) {
            throw new \InvalidArgumentException(
                'Expected Invoice instance.'
            );
        }

        $writer = new DomXmlWriter;
        $writer->startDocument();
        $writer->createRoot('rDE');

        $mapper = new InvoiceNodeMapper($writer);
        $mapper->map($document);

        return $writer->toString();
    }
}
