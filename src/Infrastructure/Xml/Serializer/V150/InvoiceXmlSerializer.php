<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Serializer\V150;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\ElectronicDocument;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\XmlSerializerInterface;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150\InvoiceNodeMapper;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Writer\XmlTreeRenderer;
use Override;

final class InvoiceXmlSerializer implements XmlSerializerInterface
{
    #[Override]
    public function serialize(object $document): string
    {
        if (! $document instanceof ElectronicDocument) {
            throw new \InvalidArgumentException(
                'Expected Invoice instance.'
            );
        }

        $tree = (new InvoiceNodeMapper)
            ->map($document);

        return (new XmlTreeRenderer)
            ->render($tree);
    }
}
