<?php

namespace Nyxcode\PhpSifenTool\Infrastructure\Catalog\Geographic;

use Nyxcode\PhpSifenTool\Domain\Catalog\Contracts\GeographicCatalog;

final class Loader
{
    public static function default(): GeographicCatalog
    {
        return new JsonGeographicCatalog(
            __DIR__.'/../../../Resources/catalogs'
        );
    }
}
