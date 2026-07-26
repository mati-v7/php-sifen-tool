<?php

namespace Nyxcode\PhpSifenTool\Infrastructure\Catalog\Currency;

use Nyxcode\PhpSifenTool\Domain\Catalog\Contracts\CurrencyCatalog;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\CurrencyCode;
use Override;

final class JsonCurrencyCatalog implements CurrencyCatalog
{
    /**
     * @var array<string, Currency>
     */
    private array $currencies = [];

    public function __construct(string $resourcePath)
    {
        foreach ($this->load($resourcePath . '/currencies.json') as $row) {
            $this->currencies[$row['code']] = new Currency(
                code: $row['code'],
                description: $row['description'],
            );
        }
    }

    #[Override]
    public function resolve(CurrencyCode $code): Currency
    {
        return $this->currencies[$code->value()]
            ?? throw new \InvalidArgumentException(
                sprintf(
                    'Currency "%s" was not found.',
                    $code->value(),
                ),
            );
    }

    #[Override]
    public function all(): iterable
    {
        yield from $this->currencies;
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
