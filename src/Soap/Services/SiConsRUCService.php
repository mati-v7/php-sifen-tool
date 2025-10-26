<?php

namespace Nyxcode\PhpSifenTool\Soap\Services;

use Nyxcode\PhpSifenTool\Builder\Request\Director;
use Nyxcode\PhpSifenTool\Builder\Request\Concrete\ConsultaRUCBuilder;
use Nyxcode\PhpSifenTool\Events\SoapRequestSent;
use Nyxcode\PhpSifenTool\Security\SifenCredential;
use Nyxcode\PhpSifenTool\Soap\Classmap\ResConsRUC;
use Nyxcode\PhpSifenTool\Soap\Contracts\SiConsRUC;
use Nyxcode\PhpSifenTool\Utils\Utilities;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class SiConsRUCService implements SiConsRUC
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

    public function rEnviConsRUC(int $dId, string $dRUCCons): ResConsRUC
    {
        $builder = new ConsultaRUCBuilder();
        $director = new Director();

        $director->setBuilder($builder);
        $director->buildPayload(
            [
                'dId' => $dId,
                'dRUCCons' => $dRUCCons
            ]
        );

        $xml = Utilities::removeXmlProlog($builder->getResult()->saveXML());
        $params = new \SoapVar($xml, XSD_ANYXML);

        try {
            /** 
             * @var \Nyxcode\PhpSifenTool\Soap\Classmap\ResConsRUC $response 
             */
            $response = $this->client->__soapCall('rEnviConsRUC', [$params]);

            if ($this->dispatcher) {
                $this->dispatcher->dispatch(
                    new SoapRequestSent(
                        null,
                        'rEnviConsRUC',
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
                        'rEnviConsRUC',
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
