<?php

namespace Nyxcode\PhpSifenTool\Tests\Feature;

use Nyxcode\PhpSifenTool\Crypto\Certificate;
use Nyxcode\PhpSifenTool\Enums\Soap\Host;
use Nyxcode\PhpSifenTool\Security\SifenCredential;
use Nyxcode\PhpSifenTool\Sifen;
use Nyxcode\PhpSifenTool\Soap\Services\SiConsRUCService;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class SiConsRUCTest extends TestCase
{

    private SifenCredential $sifenCredential;

    protected function setUp(): void
    {
        $this->sifenCredential = new SifenCredential(
            new Certificate(
                __DIR__ . '/../../.vscode/certificado.pem'
            ),
            '0001',
            'ABCD0000000000000000000000000000'
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
                $this->sifenCredential
            );
            $sifen->enableDebugLogging(__DIR__ . '/../../storage/logs/soap.log');

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
