<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\Common\Collection;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\EconomicActivity;

final class EconomicActivityCollection
{
    /**
     * @var EconomicActivity[]
     */
    private array $items;

    public function __construct(
        EconomicActivity ...$items
    ) {
        if (count($items) === 0) {
            throw new \DomainException(
                'Issuer must have at least one economic activity.'
            );
        }

        $this->items = $items;
    }

    /**
     * @return EconomicActivity[]
     */
    public function all(): array
    {
        return $this->items;
    }
}
