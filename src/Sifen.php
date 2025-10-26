<?php

namespace Nyxcode\PhpSifenTool;

use Nyxcode\PhpSifenTool\Enums\Soap\WDSL;
use Nyxcode\PhpSifenTool\Events\SoapRequestSent;
use Nyxcode\PhpSifenTool\Listeners\SoapRequestLogger;
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
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

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
    protected ?EventDispatcherInterface $dispatcher = null;

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
        $service = new SiConsDEService(
            $this->createSoapClient(WDSL::WS_CONSULTAS_CONSULTA_DE_PATH),
            $this->dispatcher
        );
        return $service->rEnviConsDe($dId, $dCDC);
    }

    public function consultarRUC(int $dId, string $dRUC): ResConsRUC
    {
        $service = new SiConsRUCService(
            $this->createSoapClient(WDSL::WS_CONSULTAS_CONSULTA_RUC_PATH),
            $this->dispatcher
        );
        return $service->rEnviConsRuc($dId, $dRUC);
    }

    public function consultarLote(int $dId, string $dProtConsLote): ResResultLoteDE
    {
        $service = new SiResultLoteDEService(
            $this->createSoapClient(WDSL::WS_CONSULTAS_CONSULTA_LOTE_PATH),
            $this->dispatcher
        );
        return $service->rEnviConsLoteDe($dId, $dProtConsLote);
    }

    public function enviarDE(int $dId, array $data): RRetEnviDE
    {
        $service = new SiRecepDEService(
            $this->createSoapClient(WDSL::WS_SYNC_RECIBE_DE_PATH),
            $this->dispatcher
        );
        return $service->rEnviDe($dId, $data, $this->sifenCredential);
    }

    public function setEventDispatcher(EventDispatcherInterface $dispatcher): void
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * Enables debug logging for SOAP requests by setting up an event dispatcher
     * with a listener that logs SOAP requests to the specified log file path.
     *
     * @param string $logFilePath The file path where SOAP request logs will be written.
     *
     * @return void
     */
    public function enableDebugLogging(string $logFilePath): void
    {
        $dispatcher = new EventDispatcher();
        $dispatcher->addListener(
            SoapRequestSent::NAME,
            new SoapRequestLogger($logFilePath)
        );
        $this->setEventDispatcher($dispatcher);
    }
}
