<?php

namespace Nyxcode\PhpSifenTool\Infrastructure\Catalog\Country;

use Nyxcode\PhpSifenTool\Domain\Catalog\Contracts\CountryCatalog;

final class CountryCatalogLoader
{
    public static function default(): CountryCatalog
    {
        return new JsonCountryCatalog(
            __DIR__.'/../../../Resources/catalogs'
        );
    }
}
