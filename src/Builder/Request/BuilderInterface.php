<?php

namespace Nyxcode\PhpSifenTool\Builder\Request;

use Nyxcode\PhpSifenTool\Security\SifenCredential;

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
     * @param \Nyxcode\PhpSifenTool\Security\SifenCredential $sifenCredential
     */
    public function body(array $data, SifenCredential $sifenCredential): void;
    public function getResult(): string;
}
