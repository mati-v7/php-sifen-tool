<?php

namespace Nyxcode\PhpSifenTool\Tests\Feature;

use Nyxcode\PhpSifenTool\Builder\Request\Concrete\ResultLoteDE;
use Nyxcode\PhpSifenTool\Builder\Request\Director;
use Nyxcode\PhpSifenTool\Crypto\Certificate;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class SiResultLoteDE extends TestCase
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
                'dProtConsLote' => '123456789012345'
            ]]
        ];
    }

    #[DataProvider('dataProvider')]
    public function test_build_si_result_lote_de_payload($data)
    {
        $builder = new ResultLoteDE();

        $director = new Director();
        $director->setBuilder($builder);
        $director->buildPayload($data);

        $result = $builder->getResult();

        $this->assertStringContainsString('<rEnviConsLoteDe xmlns="http://ekuatia.set.gov.py/sifen/xsd">', $result);
        $this->assertStringContainsString('<dId>' . $data['dId'] . '</dId>', $result);
        $this->assertStringContainsString('<dProtConsLote>' . $data['dProtConsLote'] . '</dProtConsLote>', $result);
    }
}
