<?php

namespace Nyxcode\PhpSifenTool\Builder\Request;

/**
 * Interface BuilderInterface
 *
 * Defines the contract for builder classes that construct and retrieve objects.
 */
interface BuilderInterface
{
    public function reset(): void;
    /**
     * @param array<mixed> $data
     */
    public function body(array $data): void;
    public function getResult(): string;
}
