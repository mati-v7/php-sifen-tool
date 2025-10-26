<?php

namespace Nyxcode\PhpSifenTool\Tests\Feature;

use Nyxcode\PhpSifenTool\Crypto\Certificate;
use Nyxcode\PhpSifenTool\Enums\Soap\Host;
use Nyxcode\PhpSifenTool\Security\SifenCredential;
use Nyxcode\PhpSifenTool\Sifen;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class SiConsDETest extends TestCase
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
                'dCDC' => '01800782585001001000103822025091911072098156'
            ]]
        ];
    }

    #[DataProvider('dataProvider')]
    public function test_send_cons_de($data)
    {
        try {
            $sifen = new Sifen(
                Host::PRODUCTION,
                $this->sifenCredential
            );
            $sifen->enableDebugLogging(__DIR__ . '/../../storage/logs/soap.log');

            $response = $sifen->consultarDE($data['dId'], $data['dCDC']);

            $this->assertIsObject($response);
            $this->assertEquals($response->cdcFound(), true, 'CDC should be found');

            // echo "\n✅ Respuesta:\n";
            // print_r($response);
        } catch (\Exception $e) {
            $this->fail('Error in response: ' . $e->getMessage());
        }
    }
}
