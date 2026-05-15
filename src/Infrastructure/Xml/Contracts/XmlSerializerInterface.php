<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts;

interface XmlSerializerInterface
{
    public function serialize(object $document): string;
}
