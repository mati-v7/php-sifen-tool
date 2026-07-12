<?php

namespace Nyxcode\PhpSifenTool\Infrastructure\Catalog\Geographic;

use Nyxcode\PhpSifenTool\Domain\Catalog\Contracts\GeographicCatalog;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\CityCode;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\GeographicLocation;
use Override;

final class JsonGeographicCatalog implements GeographicCatalog
{
    private array $departments;

    private array $districts;

    private array $cities;

    public function __construct(string $resourcePath)
    {
        foreach ($this->load($resourcePath.'/departments.json') as $row) {
            $this->departments[$row['code']] = new Department(
                code: $row['code'],
                name: $row['name'],
            );
        }

        foreach ($this->load($resourcePath.'/districts.json') as $row) {
            $this->districts[$row['code']] = new District(
                code: $row['code'],
                departmentCode: $row['department'],
                name: $row['name'],
            );
        }

        foreach ($this->load($resourcePath.'/cities.json') as $row) {
            $this->cities[$row['code']] = new City(
                code: $row['code'],
                districtCode: $row['district'],
                name: $row['name'],
            );
        }
    }

    #[Override]
    public function resolve(CityCode $city): GeographicLocation
    {
        $cityEntity = $this->cities[$city->value()]
            ?? throw new \InvalidArgumentException(
                sprintf('City "%s" was not found.', $city->value())
            );

        $district = $this->districts[$cityEntity->districtCode]
            ?? throw new \RuntimeException(
                sprintf(
                    'District "%s" referenced by city "%s" was not found.',
                    $cityEntity->districtCode,
                    $city->value(),
                )
            );

        $department = $this->departments[$district->departmentCode]
            ?? throw new \RuntimeException(
                sprintf(
                    'Department "%s" referenced by district "%s" was not found.',
                    $district->departmentCode,
                    $district->code,
                )
            );

        return new GeographicLocation(
            city: $cityEntity,
            district: $district,
            department: $department,
        );
    }

    private function load(string $file): array
    {
        return json_decode(
            file_get_contents($file),
            true,
            flags: JSON_THROW_ON_ERROR
        );
    }
}
