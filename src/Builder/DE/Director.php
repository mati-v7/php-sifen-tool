<?php

namespace Nyxcode\PhpSifenTool\Builder\DE;


class Director
{
    private BuilderInterface $builder;

    public function setBuilder(BuilderInterface $builder)
    {
        $this->builder = $builder;
    }
    public function getBuilder()
    {
        return $this->builder;
    }
    public function buildFacturaElectronica($data)
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
    }
}
