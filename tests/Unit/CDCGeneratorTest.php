<?php

namespace Nyxcode\PhpSifenTool\Tests\Unit;

use Nyxcode\PhpSifenTool\Builder\DE\AbstractDEBuilder;
use Nyxcode\PhpSifenTool\Builder\DE\BuilderInterface;
use Nyxcode\PhpSifenTool\Builder\DE\Concrete\FacturaElectronicaBuilder;
use Nyxcode\PhpSifenTool\Utils\Utilities;
use PHPUnit\Framework\Attributes\DataProvider;
use ReflectionMethod;

class CDCGeneratorTest extends \PHPUnit\Framework\TestCase
{
    protected AbstractDEBuilder $builder;

    public function setUp(): void
    {
        parent::setUp();
        $this->builder = new FacturaElectronicaBuilder;
        $this->builder->reset();
    }

    public static function dataProvider(): array
    {
        return [
            [
                "data" => [
                    'iTiDE' => 1,
                    'dRucEm' => '1234567',
                    'dDVEmi' => 8,
                    'dEst' => 2,
                    'dPunExp' => 5,
                    'dNumDoc' => 1234,
                    'iTipCont' => 1,
                    'dFeEmiDE' => '2024-10-25',
                    'iTipEmi' => 1,
                ]
            ]
        ];
    }

    #[DataProvider('dataProvider')]
    public function test_generacion_cdc_tiene_longitud_correcta($data)
    {
        $cdc = $this->builder->generateCDC($data);
        $this->assertEquals(44, strlen($cdc), 'El CDC debe tener 44 caracteres');
    }

    #[DataProvider('dataProvider')]
    public function test_partes_del_cdc_se_conforman_correctamente($data)
    {
        $cdc = $this->builder->generateCDC($data);
        $sinDv = substr($cdc, 0, -1);

        $this->assertStringStartsWith('01', $cdc); // Tipo de Documento 2 dígitos
        $this->assertEquals('01234567', substr($sinDv, 2, 8)); // RUC 8 dígitos
        $this->assertEquals('8', substr($sinDv, 10, 1)); // DV Emisor
        $this->assertEquals('002', substr($sinDv, 11, 3)); // Establecimiento
        $this->assertEquals('005', substr($sinDv, 14, 3)); // Punto Exp.
        $this->assertEquals('0001234', substr($sinDv, 17, 7)); // Número Doc
        $this->assertEquals('1', substr($sinDv, 24, 1)); // Tipo contribuyente
        $this->assertEquals('20241025', substr($sinDv, 25, 8)); // Fecha emisión
        $this->assertEquals('1', substr($sinDv, 33, 1)); // Tipo emisión
    }

    #[DataProvider('dataProvider')]
    public function test_el_digito_verificador_final_es_correcto($data)
    {

        $cdc = $this->builder->generateCDC($data);

        $sinDv = substr($cdc, 0, -1);
        $dvCalculado = (new ReflectionMethod(Utilities::class, 'mod11'))
            ->invoke(null, $sinDv);

        $this->assertEquals((string)$dvCalculado, substr($cdc, -1));
    }
}
