<?php

namespace Nyxcode\PhpSifenTool\Infrastructure\Catalog\Country;

use Nyxcode\PhpSifenTool\Domain\Catalog\Contracts\CountryCatalog;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\CountryCode;
use Override;

final class JsonCountryCatalog implements CountryCatalog
{
    /**
     * @var array<string, Country>
     */
    private array $countries = [];

    public function __construct(
        string $resourcePath,
    ) {
        $countries = $this->load($resourcePath.'/countries.json');

        foreach ($countries as $row) {
            $this->countries[$row['code']] = new Country(
                code: $row['code'],
                name: $row['name'],
            );
        }
    }

    #[Override]
    public function resolve(
        CountryCode $code,
    ): Country {

        return $this->countries[$code->value()]
            ?? throw new \InvalidArgumentException(
                sprintf(
                    'Country "%s" was not found.',
                    $code->value(),
                ),
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
