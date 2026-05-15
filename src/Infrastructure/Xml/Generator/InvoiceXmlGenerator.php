<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Generator;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\Invoice;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\XmlGeneratorInterface;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Serializer\V150\InvoiceXmlSerializer;
use Override;

final class InvoiceXmlGenerator implements XmlGeneratorInterface
{
    #[Override]
    public function generate(object $document): string
    {
        if (! $document instanceof Invoice) {
            throw new \InvalidArgumentException(
                'Expected Invoice instance.'
            );
        }

        return (new InvoiceXmlSerializer)
            ->serialize($document);
    }
}
