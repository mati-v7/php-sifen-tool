<?php

namespace Nyxcode\PhpSifenTool\Tests\Feature;

use Nyxcode\PhpSifenTool\Builder\Request\Concrete\ResultLoteDEBuilder;
use Nyxcode\PhpSifenTool\Builder\Request\Director;
use Nyxcode\PhpSifenTool\Crypto\Certificate;
use Nyxcode\PhpSifenTool\Enums\Soap\Host;
use Nyxcode\PhpSifenTool\Security\SifenCredential;
use Nyxcode\PhpSifenTool\Sifen;
use Nyxcode\PhpSifenTool\Soap\Classmap\ResResultLoteDE;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class SiResultLoteDETest extends TestCase
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
                'dProtConsLote' => '1097396631784424640'
            ]]
        ];
    }

    #[DataProvider('dataProvider')]
    public function test_build_si_result_lote_de_payload($data)
    {
        $builder = new ResultLoteDEBuilder();

        $director = new Director();
        $director->setBuilder($builder);
        $director->buildPayload($data, $this->sifenCredential);

        $result = $builder->getResult()->saveXML();

        $this->assertStringContainsString('<rEnviConsLoteDe xmlns="http://ekuatia.set.gov.py/sifen/xsd">', $result);
        $this->assertStringContainsString('<dId>' . $data['dId'] . '</dId>', $result);
        $this->assertStringContainsString('<dProtConsLote>' . $data['dProtConsLote'] . '</dProtConsLote>', $result);
    }

    #[DataProvider('dataProvider')]
    public function test_send_si_result_lote_de($data): ResResultLoteDE
    {
        $sifen = new Sifen(
            Host::PRODUCTION,
            $this->sifenCredential
        );
        $sifen->enableDebugLogging(__DIR__ . '/../../storage/logs/soap.log');

        /**
         * @var \Nyxcode\PhpSifenTool\Soap\Classmap\ResResultLoteDE $response
         */
        $response = $sifen->consultarLote($data['dId'], $data['dProtConsLote']);
        $this->assertIsObject($response);

        return $response;
    }
}
