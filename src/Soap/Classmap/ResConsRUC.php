<?php

namespace Nyxcode\PhpSifenTool\Soap\Classmap;

use Nyxcode\PhpSifenTool\Enums\Soap\Response\ResConsRUC as ResponseResConsRUC;

class ResConsRUC
{
    public const NOT_FOUND_RUC = '0500';
    public const WITHOUT_PERMISSION = '0501';
    public const FOUND_RUC = '0502';

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

    public function getDCodRes(): string
    {
        return $this->dCodRes;
    }

    public function getDMsgRes(): string
    {
        return $this->dMsgRes;
    }

    public function getXContRUC(): XContRUC
    {
        return $this->xContRUC;
    }

    public function notFoundRUC(): bool
    {
        return $this->dCodRes === self::NOT_FOUND_RUC;
    }

    public function withoutPermission(): bool
    {
        return $this->dCodRes === self::WITHOUT_PERMISSION;
    }

    public function foundRUC(): bool
    {
        return $this->dCodRes === self::FOUND_RUC;
    }
}
