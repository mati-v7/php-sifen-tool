<?php

namespace Nyxcode\PhpSifenTool\Soap\Services;

use Nyxcode\PhpSifenTool\Builder\Request\Concrete\ConsDEBuilder;
use Nyxcode\PhpSifenTool\Builder\Request\Director;
use Nyxcode\PhpSifenTool\Security\SifenCredential;
use Nyxcode\PhpSifenTool\Soap\Classmap\ResConsDE;
use Nyxcode\PhpSifenTool\Soap\Contracts\SiConsDE;
use Nyxcode\PhpSifenTool\Utils\Utilities;

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

        $director->buildPayload(
            [
                'dId' => $dId,
                'dCDC' => $dCDC
            ]
        );

        $xml = Utilities::removeXmlProlog($builder->getResult()->saveXML());
        $params = new \SoapVar($xml, XSD_ANYXML);

        return $this->client->__soapCall('rEnviConsDe', [$params]);
    }
}
