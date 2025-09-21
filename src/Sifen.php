<?php

namespace Nyxcode\PhpSifenTool;

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
    protected string $wsdl;
    protected string $certificatePath;

    public function __construct(string $wsdl, string $certificatePath)
    {
        $this->wsdl = $wsdl;
        $this->certificatePath = $certificatePath;
    }

    private function createSoapClient()
    {
        return SoapClientFactory::create($this->wsdl, [
            'local_cert' => $this->certificatePath,
        ]);
    }

    public function consultarDE(int $dId,  string $dCDC)
    {
        $service = new SiConsDEService($this->createSoapClient());
        return $service->rEnviConsDe($dId, $dCDC);
    }

    public function consultarRUC(int $dId, string $dRUC)
    {
        $service = new SiConsRUCService($this->createSoapClient());
        return $service->rEnviConsRuc($dId, $dRUC);
    }
}
