<?php

namespace Nyxcode\PhpSifenTool\Builder\Contracts;

use DOMDocument;

/**
 * Interface RequestBuildable
 *
 * Defines the contract for builder classes that construct and retrieve objects.
 */
interface RequestBuildable
{
    public function reset(): void;
    /**
     * @param array<mixed> $data
     */
    public function body(array $data): void;
    public function getResult(): DOMDocument;
}
