<?php

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Contracts\ReceiverDocument;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Receiver;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;

interface ReceiverDocumentNodeMapper
{
    public function supports(ReceiverDocument $document): bool;

    public function map(
        XmlElement $parentNode,
        Receiver $receiver,
    ): void;
}
