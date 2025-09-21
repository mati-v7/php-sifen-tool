<?php

namespace Nyxcode\PhpSifenTool\Tests\Feature;

use Nyxcode\PhpSifenTool\Soap\Factory\SoapClientFactory;
use Nyxcode\PhpSifenTool\Soap\Services\SiConsDEService;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class SiConsDETest extends TestCase
{

    public static function dataProvider(): array
    {
        return [
            ["data" => [
                'dId' => rand(100000, 999999),
                'dCDC' => '01800782585001001000103822025091911072098156'
            ]]
        ];
    }

    #[DataProvider('dataProvider')]
    public function test_build_cons_de_raw($data)
    {
        $client = SoapClientFactory::create(
            'https://sifen.set.gov.py/de/ws/consultas/consulta.wsdl?wsdl',
            [
                'local_cert' => __DIR__ . '/../../.vscode/certificado.pem',
            ]
        );

        try {
            $service = new SiConsDEService($client);
            $response = $service->rEnviConsDe($data['dId'], $data['dCDC']);

            // Ejemplo de acceso a propiedades si el mapeo está bien configurado:
            if (property_exists($response, 'dId')) {
                $this->assertEquals($data['dId'], $response->dId);
            }
            if (property_exists($response, 'dCDC')) {
                $this->assertEquals($data['dCDC'], $response->dCDC);
            }

            echo "\n✅ Respuesta:\n";
        } catch (\Exception $e) {
            echo "\n❌ Error SOAP: {$e->getMessage()}\n";
            echo "Request enviado:\n" . $client->__getLastRequest() . "\n\n";
            echo "Response recibido:\n" . $client->__getLastResponse() . "\n";
            $this->fail('Error in response: ' . $e->getMessage());
        }
    }
}
