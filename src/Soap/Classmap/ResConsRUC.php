<?php

namespace Nyxcode\PhpSifenTool\Soap\Classmap;

use Nyxcode\PhpSifenTool\Enums\Soap\Response\ResConsRUC as ResponseResConsRUC;

class ResConsRUC
{
    /**
     * Código del resultado de la consulta RUC 
     * @var string 
     * */
    public string $dCodRes;

    /**
     * Mensaje del resultado de la consulta RUC
     *  @var string
     * */
    public string $dMsgRes;

    /**
     * Contenedor del RUC
     * */
    public XContRUC $xContRUC;

    public function getXContRUC(): XContRUC
    {
        return $this->xContRUC;
    }

    public function notFoundRUC(): bool
    {
        return $this->dCodRes === ResponseResConsRUC::NOT_FOUND_RUC;
    }

    public function withoutPermission(): bool
    {
        return $this->dCodRes === ResponseResConsRUC::WITHOUT_PERMISSION;
    }

    public function foundRUC(): bool
    {
        return $this->dCodRes === ResponseResConsRUC::FOUND_RUC;
    }
}
