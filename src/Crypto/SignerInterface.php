<?php

namespace Nyxcode\PhpSifenTool\Crypto;

interface SignerInterface
{
    public function sign(string $xml);
}
