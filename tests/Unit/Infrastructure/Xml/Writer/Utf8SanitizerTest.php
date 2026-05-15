<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Tests\Unit\Infrastructure\Xml\Writer;

use Nyxcode\PhpSifenTool\Infrastructure\Xml\Writer\Utf8Sanitizer;
use PHPUnit\Framework\TestCase;

final class Utf8SanitizerTest extends TestCase
{
    public function test_sanitize_removes_invalid_utf8_characters(): void
    {
        $input = "Valid string with emoji \u{1F600}";
        $expected = 'Valid string with emoji 😀';

        $sanitized = Utf8Sanitizer::sanitize($input);

        $this->assertEquals($expected, $sanitized);
    }
}
