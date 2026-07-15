<?php

namespace Nyxcode\PhpSifenTool\Tests\Unit\Infrastructure\Catalog\Country;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\CountryCode;
use Nyxcode\PhpSifenTool\Infrastructure\Catalog\Country\JsonCountryCatalog;
use Override;
use PHPUnit\Framework\TestCase;

final class JsonCountryCatalogTest extends TestCase
{
    protected JsonCountryCatalog $catalog;

    #[Override]
    protected function setUp(): void
    {
        parent::setUp();
        $this->catalog = new JsonCountryCatalog(
            __DIR__ . '/../../../../Fixtures/catalog'
        );
    }

    public function test_it_resolves_paraguay(): void
    {

        $country = $this->catalog->resolve(
            new CountryCode('PRY')
        );

        self::assertSame('PRY', $country->code());
        self::assertSame('Paraguay', $country->name());
    }

    public function test_it_throws_when_country_does_not_exist(): void
    {

        $this->expectException(
            \InvalidArgumentException::class
        );

        $this->catalog->resolve(
            new CountryCode('XXX')
        );
    }
}
