<?php

namespace Nyxcode\PhpSifenTool\Soap\Contracts;

use Nyxcode\PhpSifenTool\Security\SifenCredential;
use Nyxcode\PhpSifenTool\Soap\Classmap\RRetEnviDE;

interface SiRecepDE
{
    public function rEnviDe(int $dId, array $data, SifenCredential $sifenCredential): RRetEnviDE;
}
