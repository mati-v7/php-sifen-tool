<?php

namespace Nyxcode\PhpSifenTool\Soap\Services;

use Nyxcode\PhpSifenTool\Builder\Request\Concrete\ResultLoteDEBuilder;
use Nyxcode\PhpSifenTool\Builder\Request\Director;
use Nyxcode\PhpSifenTool\Security\SifenCredential;
use Nyxcode\PhpSifenTool\Soap\Classmap\ResResultLoteDE;
use Nyxcode\PhpSifenTool\Soap\Contracts\SiResultLoteDE;
use Nyxcode\PhpSifenTool\Utils\Utilities;

class SiResultLoteDEService implements SiResultLoteDE
{
    private \SoapClient $client;

    public function __construct(\SoapClient $client)
    {
        $this->client = $client;
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

        return $this->client->__soapCall('rEnviConsLoteDe', [$params]);
    }
}
