<?php

namespace Nyxcode\PhpSifenTool\Tests\Feature;

use Nyxcode\PhpSifenTool\Crypto\Certificate;
use Nyxcode\PhpSifenTool\Enums\Soap\Host;
use Nyxcode\PhpSifenTool\Sifen;
use Nyxcode\PhpSifenTool\Soap\Services\SiConsRUCService;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class SiConsRUCTest extends TestCase
{

    private Certificate $certificate;

    protected function setUp(): void
    {
        $this->certificate = new Certificate(
            __DIR__ . '/../../.vscode/certificado.pem'
        );
    }

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
    public function test_send_cons_ruc($data)
    {
        try {
            $sifen = new Sifen(
                Host::PRODUCTION,
                $this->certificate
            );

            /**
             * @var \Nyxcode\PhpSifenTool\Soap\Classmap\ResConsRUC $response
             */
            $response = $sifen->consultarRUC($data['dId'], $data['dRUCCons']);

            $this->assertIsObject($response);
            $this->assertEquals($response->foundRUC(), true, 'RUC should be found');

            // echo "\n✅ Respuesta:\n";
            // print_r($response);
        } catch (\Throwable $th) {
            $this->fail('Error in response: ' . $th->getMessage());
        }
    }
}
