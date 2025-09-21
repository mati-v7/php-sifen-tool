<?php

namespace Nyxcode\PhpSifenTool\Tests\Feature;

use Nyxcode\PhpSifenTool\Soap\Factory\SoapClientFactory;
use Nyxcode\PhpSifenTool\Soap\Services\SiConsRUCService;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ConsRUCTest extends TestCase
{

    public static function dataProvider(): array
    {
        return [
            ["data" => [
                'dId' => rand(100000, 999999),
                'dRUCCons' => '80038258'
            ]]
        ];
    }

    #[DataProvider('dataProvider')]
    public function test_build_cons_ruc_message($data)
    {
        $client = SoapClientFactory::create(
            'https://sifen-test.set.gov.py/de/ws/consultas/consulta.wsdl?wsdl',
            [
                'local_cert' => __DIR__ . '/../../.vscode/certificado.pem',
            ]
        );
        try {

            $service = new SiConsRUCService($client);
            $response = $service->rEnviConsRUC($data['dId'], $data['dRUCCons']);
            $this->assertIsObject($response);
        } catch (\Throwable $th) {
            echo $client->__getLastRequest();
            echo $client->__getLastResponse();
            $this->fail($th->getMessage());
        }
    }
}
