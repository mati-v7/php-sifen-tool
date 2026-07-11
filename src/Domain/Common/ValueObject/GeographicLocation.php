<?php

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

use Nyxcode\PhpSifenTool\Infrastructure\Catalog\Geographic;

final readonly class GeographicLocation
{
    public function __construct(
        public Geographic\City $city,
        public Geographic\District $district,
        public Geographic\Department $department,
    ) {}

    public function city(): Geographic\City
    {
        return $this->city;
    }

    public function district(): Geographic\District
    {
        return $this->district;
    }

    public function department(): Geographic\Department
    {
        return $this->department;
    }
}
