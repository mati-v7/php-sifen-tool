<?php

namespace Nyxcode\PhpSifenTool\Soap\Services;

use Nyxcode\PhpSifenTool\Builder\Request\Concrete\ResultLoteDEBuilder;
use Nyxcode\PhpSifenTool\Builder\Request\Director;
use Nyxcode\PhpSifenTool\Events\SoapRequestSent;
use Nyxcode\PhpSifenTool\Security\SifenCredential;
use Nyxcode\PhpSifenTool\Soap\Classmap\ResResultLoteDE;
use Nyxcode\PhpSifenTool\Soap\Contracts\SiResultLoteDE;
use Nyxcode\PhpSifenTool\Utils\Utilities;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class SiResultLoteDEService implements SiResultLoteDE
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

    public function rEnviConsLoteDe(int $dId, string $dProtConsLote): ResResultLoteDE
    {
        $builder = new ResultLoteDEBuilder();

        $director = new Director();
        $director->setBuilder($builder);

        $director->buildPayload(
            [
                'dId' => $dId,
                'dProtConsLote' => $dProtConsLote
            ]
        );

        $xml = Utilities::removeXmlProlog($builder->getResult()->saveXML());
        $params = new \SoapVar($xml, XSD_ANYXML);

        try {
            /** 
             * @var \Nyxcode\PhpSifenTool\Soap\Classmap\ResResultLoteDE $response 
             */
            $response = $this->client->__soapCall('rEnviConsLoteDe', [$params]);

            if ($this->dispatcher) {
                $this->dispatcher->dispatch(
                    new SoapRequestSent(
                        null,
                        'rEnviConsLoteDe',
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
                        'rEnviConsLoteDe',
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
