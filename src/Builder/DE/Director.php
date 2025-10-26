<?php

namespace Nyxcode\PhpSifenTool\Builder\DE;

use Nyxcode\PhpSifenTool\Builder\Contracts\DEBuildable;

/**
 * Class Director
 *
 * The Director class is responsible for managing the construction process of a complex object
 * using the Builder design pattern. It delegates the construction steps to a DEBuildable
 * implementation, allowing for flexible and modular object creation.
 *
 * @property DEBuildable $builder The builder instance used to construct the object.
 */
class Director
{
    private DEBuildable $builder;

    public function setBuilder(DEBuildable $builder): void
    {
        $this->builder = $builder;
    }
    public function getBuilder(): DEBuildable
    {
        return $this->builder;
    }

    /**
     * Builds an electronic document using the provided data.
     *
     * @param array<mixed> $data The data required to construct the electronic invoice.
     */
    public function build(array $data): void
    {
        $this->builder->reset();
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
