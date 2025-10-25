<?php

namespace Nyxcode\PhpSifenTool\Soap\Contracts;

use Nyxcode\PhpSifenTool\Soap\Classmap\ResConsRUC;

interface SiConsRUC
{
    /**
     * Sends a RUC (Registro Único de Contribuyentes) consultation request.
     *
     * @param int $dId The identifier for the request.
     * @param string $dRUCCons The RUC number to be consulted.
     *
     * @return \Nyxcode\PhpSifenTool\Soap\Classmap\ResConsRUC The response from the RUC consultation.
     */
    public function rEnviConsRUC(int $dId, string $dRUCCons): ResConsRUC;
}
