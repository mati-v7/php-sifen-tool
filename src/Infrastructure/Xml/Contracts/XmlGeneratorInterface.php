<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts;

interface XmlGeneratorInterface
{
    public function generate(object $document): string;
}
