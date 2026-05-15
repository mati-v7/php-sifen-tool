<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts;

use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;

interface XmlNodeMapperInterface
{
    public function map(object $document): XmlElement;
}
