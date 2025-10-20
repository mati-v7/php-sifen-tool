<?php

namespace Nyxcode\PhpSifenTool;

use Nyxcode\PhpSifenTool\Crypto\Certificate;
use Nyxcode\PhpSifenTool\Enums\Soap\WDSL;
use Nyxcode\PhpSifenTool\Soap\Classmap\ResConsDE;
use Nyxcode\PhpSifenTool\Soap\Classmap\ResConsRUC;
use Nyxcode\PhpSifenTool\Soap\Classmap\ResResultLoteDE;
use Nyxcode\PhpSifenTool\Soap\Factory\SoapClientFactory;
use Nyxcode\PhpSifenTool\Soap\Services\SiConsDEService;
use Nyxcode\PhpSifenTool\Soap\Services\SiConsRUCService;
use Nyxcode\PhpSifenTool\Soap\Services\SiResultLoteDEService;

/**
 * Class Sifen
 *
 * Facade for interacting with Sifen SOAP web services.
 *
 * @package SifenTool
 */
class Sifen
{
    protected string $host;
    protected Certificate $certificate;

    public function __construct(string $host, Certificate $certificate)
    {
        $this->host = $host;
        $this->certificate = $certificate;
    }

    private function createSoapClient(string $wsdl): \SoapClient
    {
        return SoapClientFactory::create(
            $this->host . $wsdl,
            $this->certificate->getSoapOptions()
        );
    }

    public function consultarDE(int $dId, string $dCDC): ResConsDE
    {
        $service = new SiConsDEService($this->createSoapClient(WDSL::WS_CONSULTAS_CONSULTA_DE_PATH));
        return $service->rEnviConsDe($dId, $dCDC);
    }

    public function consultarRUC(int $dId, string $dRUC): ResConsRUC
    {
        $service = new SiConsRUCService($this->createSoapClient(WDSL::WS_CONSULTAS_CONSULTA_RUC_PATH));
        return $service->rEnviConsRuc($dId, $dRUC);
    }

    public function consultarLote(int $dId, string $dProtConsLote): ResResultLoteDE
    {
        $service = new SiResultLoteDEService($this->createSoapClient(WDSL::WS_CONSULTAS_CONSULTA_LOTE_PATH));
        return $service->rEnviConsLoteDe($dId, $dProtConsLote);
    }
}
