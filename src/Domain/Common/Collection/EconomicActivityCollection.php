<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\Common\Collection;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\EconomicActivity;
use Override;

final class EconomicActivityCollection implements \Countable, \IteratorAggregate
{
    /**
     * @var EconomicActivity[]
     */
    private array $items;

    public function __construct(EconomicActivity ...$items)
    {
        if ($items === []) {
            throw new \DomainException(
                'Issuer must contain at least one economic activity.'
            );
        }

        $this->items = $items;
    }

    #[Override]
    public function getIterator(): \Traversable
    {
        yield from $this->items;
    }

    #[Override]
    public function count(): int
    {
        return count($this->items);
    }
}
