<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Writer;

final class Utf8Sanitizer
{
    public static function sanitize(string $value): string
    {
        $value = mb_convert_encoding(
            $value,
            'UTF-8',
            'UTF-8'
        );

        return trim($value);
    }
}
