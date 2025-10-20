<?php

namespace Nyxcode\PhpSifenTool\Soap\Contracts;

use Nyxcode\PhpSifenTool\Soap\Classmap\ResConsDE;

interface SiConsDE
{
    public function rEnviConsDe(int $dId, string $dCDC): ResConsDE;
}
