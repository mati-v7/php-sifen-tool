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
     * Builds the payload for the request using the provided data.
     *
     * This method resets the current state of the builder and sets the request body
     * with the given data.
     *
     * @param mixed $data The data to be used as the request payload.
     * @return void
     */
    public function buildPayload($data)
    {
        $this->builder->reset();
        $this->builder->body($data);
    }
}
