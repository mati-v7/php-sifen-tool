<?php

namespace Nyxcode\PhpSifenTool\Infrastructure\Catalog\UnitOfMeasure;

use Nyxcode\PhpSifenTool\Domain\Catalog\Contracts\UnitOfMeasureCatalog;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\UnitOfMeasureCode;
use Override;

final class JsonUnitOfMeasureCatalog implements UnitOfMeasureCatalog
{
    /**
     * @var array<int, UnitOfMeasure>
     */
    private array $unitsOfMeasure = [];

    public function __construct(string $resourcePath)
    {
        foreach ($this->load($resourcePath.'/units_of_measure.json') as $row) {
            $this->unitsOfMeasure[$row['code']] = new UnitOfMeasure(
                code: $row['code'],
                representation: $row['representation'],
                description: $row['description'],
            );
        }
    }

    #[Override]
    public function resolve(UnitOfMeasureCode $code): UnitOfMeasure
    {
        return $this->unitsOfMeasure[$code->value()]
            ?? throw new \InvalidArgumentException(
                sprintf(
                    'Unit of measure "%d" was not found.',
                    $code->value(),
                ),
            );
    }

    #[Override]
    public function all(): iterable
    {
        yield from $this->unitsOfMeasure;
    }

    private function load(string $file): array
    {
        return json_decode(
            file_get_contents($file),
            true,
            flags: JSON_THROW_ON_ERROR,
        );
    }
}
