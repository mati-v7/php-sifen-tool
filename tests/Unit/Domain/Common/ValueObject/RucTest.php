<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Tests\Unit\Domain\Common\ValueObject;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Ruc;
use PHPUnit\Framework\TestCase;

final class RucTest extends TestCase
{
    public function testValidRuc(): void
    {
        $ruc = new Ruc('12345678-9');
        $this->assertSame('12345678-9', $ruc->value());
    }

    public function testInvalidRuc(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Ruc('invalid-ruc');
    }
}
