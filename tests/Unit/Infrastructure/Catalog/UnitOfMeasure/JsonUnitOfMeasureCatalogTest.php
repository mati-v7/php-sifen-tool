<?php

namespace Nyxcode\PhpSifenTool\Tests\Unit\Infrastructure\Catalog\UnitOfMeasure;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\UnitOfMeasureCode;
use Nyxcode\PhpSifenTool\Infrastructure\Catalog\UnitOfMeasure\JsonUnitOfMeasureCatalog;
use Override;
use PHPUnit\Framework\TestCase;

final class JsonUnitOfMeasureCatalogTest extends TestCase
{
    protected JsonUnitOfMeasureCatalog $catalog;

    #[Override]
    protected function setUp(): void
    {
        parent::setUp();
        $this->catalog = new JsonUnitOfMeasureCatalog(
            __DIR__.'/../../../../Fixtures/catalog'
        );
    }

    public function test_it_resolves_unidad(): void
    {

        $unitOfMeasure = $this->catalog->resolve(
            new UnitOfMeasureCode(77)
        );

        self::assertSame(77, $unitOfMeasure->code());
        self::assertSame('UNI', $unitOfMeasure->representation());
        self::assertSame('Unidad', $unitOfMeasure->description());
    }

    public function test_it_throws_when_unit_of_measure_does_not_exist(): void
    {

        $this->expectException(
            \InvalidArgumentException::class
        );

        $this->catalog->resolve(
            new UnitOfMeasureCode(999999)
        );
    }
}
