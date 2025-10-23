<?php

namespace Nyxcode\PhpSifenTool\Soap\Contracts;

use Nyxcode\PhpSifenTool\Security\SifenCredential;
use Nyxcode\PhpSifenTool\Soap\Classmap\ResResultLoteDE;

interface SiResultLoteDE
{
    public function rEnviConsLoteDe(int $dId, string $dProtConsLote, SifenCredential $sifenCredential): ResResultLoteDE;
}
