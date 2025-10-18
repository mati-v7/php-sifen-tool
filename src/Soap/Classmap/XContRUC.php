<?php

namespace Nyxcode\PhpSifenTool\Soap\Classmap;

use Nyxcode\PhpSifenTool\Enums\Soap\Response\ResConsRUC;

class XContRUC
{
    /** @var string RUC Consultado */
    public string $dRUCCons;

    /** @var string Razón social del RUC Consultado */
    public string $dRazCons;

    /** @var string Código del Estado del RUC Consultado */
    public string $dCodEstCons;

    /** @var string Descripción Código del Estado de RUC Consultado */
    public string $dDesEstCons;

    /** @var string RUC consultado es facturador electrónico */
    public string $dRUCFactElec;

    public function getDRUCCons(): string
    {
        return $this->dRUCCons;
    }

    public function getDRazCons(): string
    {
        return $this->dRazCons;
    }

    public function getDCodEstCons(): string
    {
        return $this->dCodEstCons;
    }

    public function getDDesEstCons(): string
    {
        return $this->dDesEstCons;
    }

    public function getDRUCFactElec(): string
    {
        return $this->dRUCFactElec;
    }

    public function isElectronicInvoicer(): bool
    {
        return $this->dRUCFactElec === ResConsRUC::ES_FACTURADOR->value;
    }

    public function is(ResConsRUC $estado): bool
    {
        return $this->dCodEstCons === $estado->value;
    }
}
