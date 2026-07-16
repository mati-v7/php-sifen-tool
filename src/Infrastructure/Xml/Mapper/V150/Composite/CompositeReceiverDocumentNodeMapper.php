<?php

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150\Composite;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\Receiver;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\ReceiverDocumentNodeMapper;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;

final readonly class CompositeReceiverDocumentNodeMapper
{

    /**
     * @param iterable<ReceiverDocumentNodeMapper> $mappers
     */
    public function __construct(
        private iterable $mappers,
    ) {}

    public function map(XmlElement $parentNode, Receiver $receiver): void
    {

        foreach ($this->mappers as $mapper) {

            if ($mapper->supports($receiver->document())) {
                $mapper->map($parentNode, $receiver);

                return;
            }
        }

        throw new \LogicException(
            sprintf(
                'No mapper found for "%s".',
                $receiver->document()::class,
            ),
        );
    }
}
