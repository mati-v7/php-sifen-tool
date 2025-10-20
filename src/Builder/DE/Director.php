<?php

namespace Nyxcode\PhpSifenTool\Builder\DE;

use Nyxcode\PhpSifenTool\Crypto\Certificate;

/**
 * Class Director
 *
 * The Director class is responsible for managing the construction process of a complex object
 * using the Builder design pattern. It delegates the construction steps to a BuilderInterface
 * implementation, allowing for flexible and modular object creation.
 *
 * @property BuilderInterface $builder The builder instance used to construct the object.
 */
class Director
{
    private BuilderInterface $builder;

    public function setBuilder(BuilderInterface $builder): void
    {
        $this->builder = $builder;
    }
    public function getBuilder(): BuilderInterface
    {
        return $this->builder;
    }

    /**
     * Builds an electronic invoice (Factura Electronica) using the provided data.
     *
     * @param Certificate $certificate
     * @param array<mixed> $data The data required to construct the electronic invoice.
     */
    public function buildFacturaElectronica(Certificate $certificate, array $data): void
    {
        $this->builder->reset($certificate);
        $this->builder->setGroupAA();
        $this->builder->setGroupA($data);
        $this->builder->setGroupB($data);
        $this->builder->setGroupC($data);
        $this->builder->setGroupD($data);
        $this->builder->setGroupD1($data);
        $this->builder->setGroupD2($data);
        $this->builder->setGroupD3($data);
        $this->builder->setGroupE($data);
        $this->builder->setGroupF($data);
        $this->builder->setGroupH($data);
    }
}
