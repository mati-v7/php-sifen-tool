<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts;

interface XmlNodeMapperInterface
{
    public function map(object $document): void;
}
