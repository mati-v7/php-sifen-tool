<?php

namespace Nyxcode\PhpSifenTool\Tests\Feature;

use Nyxcode\PhpSifenTool\Enums\Soap\Host;
use Nyxcode\PhpSifenTool\Sifen;
use Nyxcode\PhpSifenTool\Soap\Services\SiConsRUCService;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class SiConsRUCTest extends TestCase
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
    public function test_send_cons_ruc($data)
    {
        try {
            $sifen = new Sifen(
                Host::PRODUCTION,
                __DIR__ . '/../../.vscode/certificado.pem'
            );

            $response = $sifen->consultarRUC($data['dId'], $data['dRUCCons']);
            $this->assertIsObject($response);

            echo "\n✅ Respuesta:\n";
            print_r($response);
        } catch (\Throwable $th) {
            $this->fail('Error in response: ' . $th->getMessage());
        }
    }
}
