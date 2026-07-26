<?php

namespace Nyxcode\PhpSifenTool\Domain\Catalog\Contracts;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\CurrencyCode;
use Nyxcode\PhpSifenTool\Infrastructure\Catalog\Currency\Currency;

interface CurrencyCatalog
{
    public function resolve(
        CurrencyCode $code
    ): Currency;

    /**
     * @return iterable<Currency>
     */
    public function all(): iterable;
}
