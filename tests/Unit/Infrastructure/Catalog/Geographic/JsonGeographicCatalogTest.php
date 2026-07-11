<?php

namespace Nyxcode\PhpSifenTool\Tests\Unit\Infrastructure\Catalog\Geographic;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\CityCode;
use Nyxcode\PhpSifenTool\Infrastructure\Catalog\Geographic\JsonGeographicCatalog;
use Override;
use PHPUnit\Framework\TestCase;

class JsonGeographicCatalogTest extends TestCase
{
    protected JsonGeographicCatalog $catalog;

    #[Override]
    public function setUp(): void
    {
        parent::setUp();

        $this->catalog = new JsonGeographicCatalog(
            __DIR__ . '/../../../../Fixtures/catalog'
        );
    }

    public function test_it_resolves_a_complete_geographic_location(): void
    {
        $location = $this->catalog->resolve(
            new CityCode(2301)
        );

        $this->assertSame(2301, $location->city->code);
        $this->assertSame('FERNANDO DE LA MORA', $location->city->name);

        $this->assertSame(230, $location->district->code);
        $this->assertSame('FERNANDO DE LA MORA', $location->district->name);

        $this->assertSame(11, $location->department->code);
        $this->assertSame('CENTRAL', $location->department->name);
    }

    public function test_it_throws_when_city_does_not_exist(): void
    {

        $this->expectException(\InvalidArgumentException::class);

        $this->catalog->resolve(
            new CityCode(999999)
        );
    }

    public function test_it_detects_missing_district_reference(): void
    {

        $this->expectException(\RuntimeException::class);

        $this->catalog->resolve(
            new CityCode(2302)
        );
    }

    public function test_it_detects_missing_department_reference(): void
    {
        $this->expectException(\RuntimeException::class);

        $this->catalog->resolve(
            new CityCode(2303)
        );
    }
}
