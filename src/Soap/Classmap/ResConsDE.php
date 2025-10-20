<?php

namespace Nyxcode\PhpSifenTool\Soap\Classmap;

class ResConsDE
{
    public const CDC_NOT_FOUND = '0420';
    public const WITHOUT_PERMISSION = '0421';
    public const CDC_FOUND = '0422';

    /**
     * Fecha y hora del procesamiento
     * @var string $dFecProc
     */
    public string $dFecProc;

    /**
     * Código del resultado de procesamiento
     * @var string $dCodRes
     */
    public string $dCodRes;

    /**
     * Mensaje del resultado de procesamiento
     * @var string $dMsgRes
     */
    public string $dMsgRes;

    /**
     * Contenedor del DE
     * @var string $xContenDE
     */
    public string $xContenDE;

    public function getDFecProc(): string
    {
        return $this->dFecProc;
    }

    public function getDCodRes(): string
    {
        return $this->dCodRes;
    }

    public function getDMsgRes(): string
    {
        return $this->dMsgRes;
    }

    public function getXContentDE(): string
    {
        return $this->xContenDE;
    }

    public function cdcFound(): bool
    {
        return $this->dCodRes === self::CDC_FOUND;
    }

    public function cdcNotFound(): bool
    {
        return $this->dCodRes === self::CDC_NOT_FOUND;
    }

    public function withoutPermision(): bool
    {
        return $this->dCodRes === self::WITHOUT_PERMISSION;
    }
}
