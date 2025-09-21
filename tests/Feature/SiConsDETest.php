<?php

namespace Nyxcode\PhpSifenTool\Tests\Feature;

use Nyxcode\PhpSifenTool\Enums\Soap\Host;
use Nyxcode\PhpSifenTool\Sifen;
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
    public function test_send_cons_de($data)
    {
        try {
            $sifen = new Sifen(
                Host::PRODUCTION,
                __DIR__ . '/../../.vscode/certificado.pem'
            );

            $response = $sifen->consultarDE($data['dId'], $data['dCDC']);

            $this->assertIsObject($response);

            echo "\n✅ Respuesta:\n";
            print_r($response);
        } catch (\Exception $e) {
            $this->fail('Error in response: ' . $e->getMessage());
        }
    }
}
