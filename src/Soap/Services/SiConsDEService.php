<?php

namespace Nyxcode\PhpSifenTool\Soap\Services;

use Nyxcode\PhpSifenTool\Builder\Request\Concrete\ConsDEBuilder;
use Nyxcode\PhpSifenTool\Builder\Request\Director;
use Nyxcode\PhpSifenTool\Soap\Classmap\ResConsDE;
use Nyxcode\PhpSifenTool\Soap\Contracts\SiConsDE;

class SiConsDEService implements SiConsDE
{
    private \SoapClient $client;

    public function __construct(\SoapClient $client)
    {
        $this->client = $client;
    }

    public function rEnviConsDe(int $dId, string $dCDC): ResConsDE
    {
        $builder = new ConsDEBuilder();
        $director = new Director();
        $director->setBuilder($builder);

        $director->buildPayload([
            'dId' => $dId,
            'dCDC' => $dCDC
        ]);

        $params = new \SoapVar($builder->getResult(), XSD_ANYXML);

        return $this->client->__soapCall('rEnviConsDe', [$params]);
    }
}
