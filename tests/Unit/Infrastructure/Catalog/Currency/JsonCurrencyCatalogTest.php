<?php

namespace Nyxcode\PhpSifenTool\Tests\Unit\Infrastructure\Catalog\Currency;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\CurrencyCode;
use Nyxcode\PhpSifenTool\Infrastructure\Catalog\Currency\JsonCurrencyCatalog;
use Override;
use PHPUnit\Framework\TestCase;

final class JsonCurrencyCatalogTest extends TestCase
{
    protected JsonCurrencyCatalog $catalog;

    #[Override]
    protected function setUp(): void
    {
        parent::setUp();
        $this->catalog = new JsonCurrencyCatalog(
            __DIR__ . '/../../../../Fixtures/catalog'
        );
    }

    public function test_it_resolves_guarani(): void
    {

        $currency = $this->catalog->resolve(
            new CurrencyCode('PYG')
        );

        self::assertSame('PYG', $currency->code());
        self::assertSame('Guarani', $currency->description());
    }

    public function test_it_throws_when_curency_does_not_exist(): void
    {

        $this->expectException(
            \InvalidArgumentException::class
        );

        $this->catalog->resolve(
            new CurrencyCode('ZZZ')
        );
    }
}
