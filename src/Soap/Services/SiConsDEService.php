<?php

namespace Nyxcode\PhpSifenTool\Soap\Services;

use Nyxcode\PhpSifenTool\Builder\Request\Concrete\ConsDEBuilder;
use Nyxcode\PhpSifenTool\Builder\Request\Director;
use Nyxcode\PhpSifenTool\Events\SoapRequestSent;
use Nyxcode\PhpSifenTool\Security\SifenCredential;
use Nyxcode\PhpSifenTool\Soap\Classmap\ResConsDE;
use Nyxcode\PhpSifenTool\Soap\Contracts\SiConsDE;
use Nyxcode\PhpSifenTool\Utils\Utilities;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class SiConsDEService implements SiConsDE
{
    private \SoapClient $client;
    private ?EventDispatcherInterface $dispatcher;

    public function __construct(
        \SoapClient $client,
        ?EventDispatcherInterface $dispatcher
    ) {
        $this->client = $client;
        $this->dispatcher = $dispatcher;
    }

    public function rEnviConsDe(int $dId, string $dCDC): ResConsDE
    {
        $builder = new ConsDEBuilder();
        $director = new Director();
        $director->setBuilder($builder);

        $director->buildPayload(
            [
                'dId' => $dId,
                'dCDC' => $dCDC
            ]
        );

        $xml = Utilities::removeXmlProlog($builder->getResult()->saveXML());
        $params = new \SoapVar($xml, XSD_ANYXML);

        try {
            /** 
             * @var \Nyxcode\PhpSifenTool\Soap\Classmap\ResConsDE $response 
             */
            $response = $this->client->__soapCall('rEnviConsDe', [$params]);

            if ($this->dispatcher) {
                $this->dispatcher->dispatch(
                    new SoapRequestSent(
                        null,
                        'rEnviConsDe',
                        $this->client->__getLastRequest(),
                        $this->client->__getLastResponse()
                    ),
                    SoapRequestSent::NAME
                );
            }

            return $response;
        } catch (\SoapFault $e) {
            if ($this->dispatcher) {
                $this->dispatcher->dispatch(
                    new SoapRequestSent(
                        null,
                        'rEnviConsDe',
                        $xml,
                        null,
                        $e->getMessage()
                    ),
                    SoapRequestSent::NAME
                );
            }
            throw $e;
        }
    }
}
