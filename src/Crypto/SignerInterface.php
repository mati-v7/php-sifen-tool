<?php

namespace Nyxcode\PhpSifenTool\Crypto;

use DOMNode;

interface SignerInterface
{
    public function sign(DOMNode $xml);
}
