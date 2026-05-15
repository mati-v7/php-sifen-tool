<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Tests\Unit\Domain\Common\ValueObject;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Percentage;
use PHPUnit\Framework\TestCase;

final class PercentageTest extends TestCase
{
    public function test_from_value(): void
    {
        $percentage = new Percentage(15);

        $this->assertSame(15, $percentage->value());
    }

    public function test_invalid_value(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new Percentage(150);
    }
}
