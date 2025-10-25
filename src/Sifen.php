<?php

namespace Nyxcode\PhpSifenTool;

use Nyxcode\PhpSifenTool\Crypto\Certificate;
use Nyxcode\PhpSifenTool\Enums\Soap\WDSL;
use Nyxcode\PhpSifenTool\Security\SifenCredential;
use Nyxcode\PhpSifenTool\Soap\Classmap\ResConsDE;
use Nyxcode\PhpSifenTool\Soap\Classmap\ResConsRUC;
use Nyxcode\PhpSifenTool\Soap\Classmap\ResResultLoteDE;
use Nyxcode\PhpSifenTool\Soap\Classmap\RRetEnviDE;
use Nyxcode\PhpSifenTool\Soap\Factory\SoapClientFactory;
use Nyxcode\PhpSifenTool\Soap\Services\SiConsDEService;
use Nyxcode\PhpSifenTool\Soap\Services\SiConsRUCService;
use Nyxcode\PhpSifenTool\Soap\Services\SiRecepDEService;
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
    protected SifenCredential $sifenCredential;

    public function __construct(string $host, SifenCredential $sifenCredential)
    {
        $this->host = $host;
        $this->sifenCredential = $sifenCredential;
    }

    private function createSoapClient(string $wsdl): \SoapClient
    {
        return SoapClientFactory::create(
            $this->host . $wsdl,
            $this->sifenCredential->getSoapOptions()
        );
    }

    public function consultarDE(int $dId, string $dCDC): ResConsDE
    {
        $service = new SiConsDEService($this->createSoapClient(WDSL::WS_CONSULTAS_CONSULTA_DE_PATH));
        return $service->rEnviConsDe($dId, $dCDC, $this->sifenCredential);
    }

    public function consultarRUC(int $dId, string $dRUC): ResConsRUC
    {
        $service = new SiConsRUCService($this->createSoapClient(WDSL::WS_CONSULTAS_CONSULTA_RUC_PATH));
        return $service->rEnviConsRuc($dId, $dRUC, $this->sifenCredential);
    }

    public function consultarLote(int $dId, string $dProtConsLote): ResResultLoteDE
    {
        $service = new SiResultLoteDEService($this->createSoapClient(WDSL::WS_CONSULTAS_CONSULTA_LOTE_PATH));
        return $service->rEnviConsLoteDe($dId, $dProtConsLote, $this->sifenCredential);
    }

    public function enviarDE(int $dId, array $data): RRetEnviDE
    {
        $service = new SiRecepDEService($this->createSoapClient(WDSL::WS_SYNC_RECIBE_DE_PATH));
        return $service->rEnviDe($dId, $data, $this->sifenCredential);
    }
}
