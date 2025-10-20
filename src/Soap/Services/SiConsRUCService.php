<?php

namespace Nyxcode\PhpSifenTool\Soap\Services;

use Nyxcode\PhpSifenTool\Builder\Request\Director;
use Nyxcode\PhpSifenTool\Builder\Request\Concrete\ConsultaRUCBuilder;
use Nyxcode\PhpSifenTool\Soap\Classmap\ResConsRUC;
use Nyxcode\PhpSifenTool\Soap\Contracts\SiConsRUC;

class SiConsRUCService implements SiConsRUC
{
    private \SoapClient $client;

    public function __construct(\SoapClient $client)
    {
        $this->client = $client;
    }

    public function rEnviConsRUC(int $dId, string $dRUCCons): ResConsRUC
    {
        $builder = new ConsultaRUCBuilder();
        $director = new Director();

        $director->setBuilder($builder);
        $director->buildPayload([
            'dId' => $dId,
            'dRUCCons' => $dRUCCons
        ]);

        $params = new \SoapVar($builder->getResult(), XSD_ANYXML);

        return $this->client->__soapCall('rEnviConsRUC', [$params]);
    }
}
