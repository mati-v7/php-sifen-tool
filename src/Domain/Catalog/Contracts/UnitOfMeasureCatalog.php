<?php

namespace Nyxcode\PhpSifenTool\Domain\Catalog\Contracts;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\UnitOfMeasureCode;
use Nyxcode\PhpSifenTool\Infrastructure\Catalog\UnitOfMeasure\UnitOfMeasure;

interface UnitOfMeasureCatalog
{
    public function resolve(
        UnitOfMeasureCode $code
    ): UnitOfMeasure;

    /**
     * @return iterable<UnitOfMeasure>
     */
    public function all(): iterable;
}
