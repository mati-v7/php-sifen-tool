<?php

namespace Nyxcode\PhpSifenTool\Tests\Feature;

use Nyxcode\PhpSifenTool\Builder\Request\Concrete\ResultLoteDEBuilder;
use Nyxcode\PhpSifenTool\Builder\Request\Director;
use Nyxcode\PhpSifenTool\Crypto\Certificate;
use Nyxcode\PhpSifenTool\Enums\Soap\Host;
use Nyxcode\PhpSifenTool\Sifen;
use Nyxcode\PhpSifenTool\Soap\Classmap\ResResultLoteDE;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class SiResultLoteDETest extends TestCase
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
        $director->buildPayload($data);

        $result = $builder->getResult();

        $this->assertStringContainsString('<rEnviConsLoteDe xmlns="http://ekuatia.set.gov.py/sifen/xsd">', $result);
        $this->assertStringContainsString('<dId>' . $data['dId'] . '</dId>', $result);
        $this->assertStringContainsString('<dProtConsLote>' . $data['dProtConsLote'] . '</dProtConsLote>', $result);
    }

    #[DataProvider('dataProvider')]
    public function test_send_si_result_lote_de($data): ResResultLoteDE
    {
        $sifen = new Sifen(
            Host::PRODUCTION,
            $this->certificate
        );

        /**
         * @var \Nyxcode\PhpSifenTool\Soap\Classmap\ResResultLoteDE $response
         */
        $response = $sifen->consultarLote($data['dId'], $data['dProtConsLote']);
        $this->assertIsObject($response);

        return $response;
    }
}
