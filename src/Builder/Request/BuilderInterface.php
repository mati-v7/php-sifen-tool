<?php

namespace Nyxcode\PhpSifenTool\Builder\Request;

/**
 * Interface BuilderInterface
 *
 * Defines the contract for builder classes that construct and retrieve objects.
 */
interface BuilderInterface
{
    public function reset();
    public function body($data);
    public function getResult();
}
