<?php

namespace Nyxcode\PhpSifenTool\Domain\Catalog\Contracts;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\CityCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\GeographicLocation;

interface GeographicCatalog
{
    public function resolve(
        CityCode $city,
    ): GeographicLocation;
}
