<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

final readonly class Address
{
    public function __construct(
        private string $street,
        private int $houseNumber,
        private ?string $complement1,
        private ?string $complement2,
        private CityCode $city,
    ) {}

    public function street(): string
    {
        return $this->street;
    }

    public function houseNumber(): int
    {
        return $this->houseNumber;
    }

    public function complement1(): ?string
    {
        return $this->complement1;
    }

    public function complement2(): ?string
    {
        return $this->complement2;
    }

    public function city(): CityCode
    {
        return $this->city;
    }
}
