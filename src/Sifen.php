<?php

namespace Nyxcode\PhpSifenTool;

use Nyxcode\PhpSifenTool\Enums\Soap\WDSL;
use Nyxcode\PhpSifenTool\Soap\Factory\SoapClientFactory;
use Nyxcode\PhpSifenTool\Soap\Services\SiConsDEService;
use Nyxcode\PhpSifenTool\Soap\Services\SiConsRUCService;

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
    protected string $certificatePath;

    public function __construct(string $host, string $certificatePath)
    {
        $this->host = $host;
        $this->certificatePath = $certificatePath;
    }

    private function createSoapClient(string $wsdl): \SoapClient
    {
        return SoapClientFactory::create($this->host . $wsdl, [
            'local_cert' => $this->certificatePath,
        ]);
    }

    public function consultarDE(int $dId,  string $dCDC)
    {
        $service = new SiConsDEService($this->createSoapClient(WDSL::WS_CONSULTAS_CONSULTA_DE_PATH));
        return $service->rEnviConsDe($dId, $dCDC);
    }

    public function consultarRUC(int $dId, string $dRUC)
    {
        $service = new SiConsRUCService($this->createSoapClient(WDSL::WS_CONSULTAS_CONSULTA_RUC_PATH));
        return $service->rEnviConsRuc($dId, $dRUC);
    }
}
