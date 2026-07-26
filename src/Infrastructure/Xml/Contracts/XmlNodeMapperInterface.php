<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts;

interface XmlNodeMapperInterface
{
    /**
     * @return class-string
     */
    public static function supports(): string;
}
