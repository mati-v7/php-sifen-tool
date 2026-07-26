<?php

namespace Nyxcode\PhpSifenTool\Infrastructure\Catalog\Currency;

use Nyxcode\PhpSifenTool\Domain\Catalog\Contracts\CurrencyCatalog;

final class Loader
{
    public static function currencies(): CurrencyCatalog
    {
        return new JsonCurrencyCatalog(
            dirname(__DIR__, 3) . '/resources/catalogs'
        );
    }
}
