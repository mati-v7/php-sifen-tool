<?php

namespace Nyxcode\PhpSifenTool\Builder\Request;

/**
 * The Director class is responsible for managing the construction process of requests
 * using a BuilderInterface implementation.
 *
 * @package Builder\Request
 */
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

    /**
     * Builds a request for consulting RUC (Registro Único de Contribuyentes) using the provided data.
     *
     * This method resets the builder state and sets the request body with the given data.
     *
     * @param mixed $data The data to be used as the body of the request.
     * @return void
     */
    public function buildConsRUC($data)
    {
        $this->builder->reset();
        $this->builder->body($data);
    }
}
