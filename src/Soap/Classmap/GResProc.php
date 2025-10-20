<?php

namespace Nyxcode\PhpSifenTool\Soap\Classmap;

class GResProc
{
    /**
     * Código de resultado de procesamiento
     * @var string $dCodRes
     */
    public string $dCodRes;

    /**
     * Mensaje de resultado de procesamiento
     * @var string $dMsgRes
     */
    public string $dMsgRes;

    public function getDCodRes(): string
    {
        return $this->dCodRes;
    }

    public function getDMsgRes(): string
    {
        return $this->dMsgRes;
    }
}
