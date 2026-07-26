<?php

namespace Nyxcode\PhpSifenTool\Domain\Catalog\Contracts;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\CountryCode;
use Nyxcode\PhpSifenTool\Infrastructure\Catalog\Country\Country;

interface CountryCatalog
{
    public function resolve(
        CountryCode $country,
    ): Country;
}
