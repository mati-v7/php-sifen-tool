<?php

namespace Nyxcode\PhpSifenTool\Tests\Feature;

use DateTime;
use Nyxcode\PhpSifenTool\Builder\Request\Concrete\RecepDEBuilder;
use Nyxcode\PhpSifenTool\Builder\Request\Director;
use Nyxcode\PhpSifenTool\Crypto\Certificate;
use Nyxcode\PhpSifenTool\Enums\DE\CondicionCredito;
use Nyxcode\PhpSifenTool\Enums\DE\DenominacionTarjeta;
use Nyxcode\PhpSifenTool\Enums\DE\FormaAfectacionIVA;
use Nyxcode\PhpSifenTool\Enums\DE\FormaProcesamientoTarjeta;
use Nyxcode\PhpSifenTool\Enums\DE\IndicadorPresencia;
use Nyxcode\PhpSifenTool\Enums\DE\MonedaOperacion;
use Nyxcode\PhpSifenTool\Enums\DE\NaturalezaReceptor;
use Nyxcode\PhpSifenTool\Enums\DE\SistemaFacturacion;
use Nyxcode\PhpSifenTool\Enums\DE\TipoCambioOperacion;
use Nyxcode\PhpSifenTool\Enums\DE\TipoCondicionOperacion;
use Nyxcode\PhpSifenTool\Enums\DE\TipoContribuyente;
use Nyxcode\PhpSifenTool\Enums\DE\TipoDocumentoAsociado;
use Nyxcode\PhpSifenTool\Enums\DE\TipoDocumentoElectronico;
use Nyxcode\PhpSifenTool\Enums\DE\TipoDocumentoReceptor;
use Nyxcode\PhpSifenTool\Enums\DE\TipoEmision;
use Nyxcode\PhpSifenTool\Enums\DE\TipoImpuesto;
use Nyxcode\PhpSifenTool\Enums\DE\TipoOperacion;
use Nyxcode\PhpSifenTool\Enums\DE\TipoPago;
use Nyxcode\PhpSifenTool\Enums\DE\TipoRegimen;
use Nyxcode\PhpSifenTool\Enums\DE\TipoTransaccion;
use Nyxcode\PhpSifenTool\Enums\Soap\Host;
use Nyxcode\PhpSifenTool\Security\SifenCredential;
use Nyxcode\PhpSifenTool\Sifen;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class SiRecepDETest extends TestCase
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
                'xDe' => [
                    "Id" => "1234567890",
                    "dDVId" => "0987654321",
                    "dFecFirma" => (new DateTime())->format(DateTime::ATOM),
                    "dSisFact" => SistemaFacturacion::CONTRIBUYENTE->value,
                    "iTipEmi" => TipoEmision::NORMAL->value,
                    "dDesTipEmi" => TipoEmision::NORMAL->getDescripcion(),
                    "dCodSeg" => 123456789,
                    "dInfoEmi" => "Información de interés del emisor respecto al DE",
                    "dInfoFisc" => "Información de interés del Fisco respecto al DE",
                    "iTiDE" => TipoDocumentoElectronico::FE->value,
                    "dNumTim" => 12345678,
                    "dEst" => "001",
                    "dPunExp" => "001",
                    "dNumDoc" => "0000001",
                    "dFeIniT" => (new DateTime())->format(DateTime::ATOM),
                    "dFeEmiDE" => (new DateTime())->format(DateTime::ATOM),
                    "iTipTra" => TipoTransaccion::VENTA_MERCADERIA->value,
                    "dDesTipTra" => TipoTransaccion::VENTA_MERCADERIA->getDescripcion(),
                    "iTImp" => TipoImpuesto::IVA->value,
                    "dDesTImp" => TipoImpuesto::IVA->getDescripcion(),
                    "cMoneOpe" => MonedaOperacion::PYG->value,
                    "dDesMoneOpe" => MonedaOperacion::PYG->getDescripcion(),
                    "dCondTiCam" => TipoCambioOperacion::GLOBAL->value,
                    "dTiCam" => 8100,
                    // "iCondAnt" => TipoCondicionAnticipo::GLOBAL->value,
                    // "dDesCondAnt" => TipoCondicionAnticipo::GLOBAL->getDescripcion(),
                    "dRucEm" => "12345678",
                    "dDVEmi" => "0",
                    "iTipCont" => TipoContribuyente::PERSONA_FISICA->value,
                    "cTipReg" => TipoRegimen::PEQUENO_PRODUCTOR->value,
                    "dNomEmi" => "EMPRESA DE EJEMPLO S.A",
                    "dNomFanEmi" => "NOMBRE DE FANTASIA DE EJEMPLO",
                    "dDirEmi" => "DIRECCION DE EJEMPLO",
                    // "dNumCas" => "21",
                    "dCompDir1" => "CALLE COMPLEMENTARIA 1 DE EJEMPLO",
                    "dCompDir2" => "CALLE COMPLEMENTARIA 2 DE EJEMPLO",
                    "cDepEmi" => "1",
                    "dDesDepEmi" => "CAPITAL",
                    "cDisEmi" => "1",
                    "dDesDisEmi" => "ASUNCION (DISTRITO)",
                    "cCiuEmi" => "1",
                    "dDesCiuEmi" => "ASUNCION (DISTRITO)",
                    "dTelEmi" => "021 123456",
                    "dEmailE" => "email@example.com",
                    "dDenSuc" => "DENOMINACION DE SUCURSAL",
                    "gActEco" => [
                        [
                            "cActEco" => 1234,
                            "dDesActEco" => "DESCRIPCION DE ACTIVIDAD ECONOMICA"
                        ],
                        [
                            "cActEco" => 5678,
                            "dDesActEco" => "DESCRIPCION DE ACTIVIDAD ECONOMICA 2"
                        ],
                    ],
                    "iNatRec" => NaturalezaReceptor::CONTRIBUYENTE->value,
                    "iTiOpe" => TipoOperacion::B2C->value,
                    "cPaisRec" => "PRY",
                    "dDesPaisRe" => "Paraguay",
                    "iTiContRec" => TipoContribuyente::PERSONA_FISICA->value,
                    "dRucRec" => "8765432",
                    "dDVRec" => "0",
                    "iTipIDRec" => TipoDocumentoReceptor::INNOMINADO->value,
                    "dDTipIDRec" => TipoDocumentoReceptor::INNOMINADO->getDescripcion(),
                    "dNumIDRec" => "1234567",
                    "dNomRec" => "CLIENTE DE PRUEBA",
                    "dNomFanRec" => "NOMBRE DE FANTASIA DE CLIENTE DE PRUEBA",
                    "dDirRec" => "DIRECCION DEL CLIENTE",
                    "dNumCasRec" => "1234",
                    "cDepRec" => "1",
                    "dDesDepRec" => "CAPITAL",
                    "cDisRec" => "1",
                    "dDesDisRec" => "ASUNCION (DISTRITO)",
                    "cCiuRec" => "1",
                    "dDesCiuRec" => "ASUNCION (DISTRITO)",
                    "dTelRec" => "021 123456",
                    "dCelRec" => "0961 123456",
                    "dEmailRec" => "cliente@cliente.com",
                    "dCodCliente" => "12",
                    "iIndPres" => IndicadorPresencia::OPERACION_PRESENCIAL->value,
                    "dDesIndPres" => IndicadorPresencia::OPERACION_PRESENCIAL->getDescripcion(),
                    "dFecEmNR" => (new DateTime())->format(DateTime::ATOM),
                    "dModCont" => "A2",
                    "dEntCont" => "12345",
                    "dAnoCont" => "25",
                    "dSecCont" => "1234567",
                    "dFeCodCont" => (new DateTime())->format(DateTime::ATOM),
                    "iCondOpe" => TipoCondicionOperacion::CREDITO->value,
                    "dDCondOpe" => TipoCondicionOperacion::CREDITO->getDescripcion(),
                    "gPaConEIni" => [
                        [
                            "iTiPago" => TipoPago::EFECTIVO->value,
                            "dDesTiPag" => TipoPago::EFECTIVO->getDescripcion(),
                            "dMonTiPag" => 1000,
                            "cMoneTiPag" => MonedaOperacion::PYG->value,
                            "dDMoneTiPag" => MonedaOperacion::PYG->getDescripcion(),
                            "dTiCamTiPag" => 8100,
                        ],
                        [
                            "iTiPago" => TipoPago::TARJETA_DEBITO->value,
                            "dDesTiPag" => TipoPago::TARJETA_DEBITO->getDescripcion(),
                            "dMonTiPag" => 1000,
                            "cMoneTiPag" => MonedaOperacion::PYG->value,
                            "dDMoneTiPag" => MonedaOperacion::PYG->getDescripcion(),
                            "dTiCamTiPag" => 8100,
                            "iDenTarj" => DenominacionTarjeta::VISA->value,
                            "dDesDenTarj" => DenominacionTarjeta::VISA->getDescripcion(),
                            "dRSProTar" => "Nombre del proveedor de la tarjeta",
                            "dRUCProTar" => "12345678",
                            "dDVProTar" => "0",
                            "iForProPa" => FormaProcesamientoTarjeta::POS->value,
                            "dCodAuOpe" => "1234567890",
                            "dNomTit" => "Nombre del titular de la tarjeta",
                            "dNumTarj" => "1234",
                        ],
                        [
                            "iTiPago" => TipoPago::CHEQUE->value,
                            "dDesTiPag" => TipoPago::CHEQUE->getDescripcion(),
                            "dMonTiPag" => 1000,
                            "cMoneTiPag" => MonedaOperacion::PYG->value,
                            "dDMoneTiPag" => MonedaOperacion::PYG->getDescripcion(),
                            "dTiCamTiPag" => 8100,
                            "dNumCheq" => "12345678",
                            "dBcoEmi" => "Nombre del banco emisor",
                        ],
                    ],
                    "iCondCred" => CondicionCredito::CUOTA->value,
                    "dDCondCred" => CondicionCredito::CUOTA->getDescripcion(),
                    "dPlazoCre" => "30 días",
                    "dCuotas" => "6",
                    "dMonEnt" => 1000,
                    "gCuotas" => [
                        [
                            "cMoneCuo" => MonedaOperacion::PYG->value,
                            "dDMoneCuo" => MonedaOperacion::PYG->getDescripcion(),
                            "dMonCuota" => 1000,
                            "dVencCuo" => (new DateTime())->format(DateTime::ATOM),
                        ],
                        [
                            "cMoneCuo" => MonedaOperacion::PYG->value,
                            "dDMoneCuo" => MonedaOperacion::PYG->getDescripcion(),
                            "dMonCuota" => 1000,
                        ],
                    ],
                    "gCamItem" => [
                        [
                            "dCodInt" => "123456",
                            "dParAranc" => "1234",
                            "dNCM" => "12345678",
                            "dDncpG" => "ABC123456",
                            "dDncpE" => "DEF1",
                            "dGtin" => "1234567890123",
                            "dGtinPq" => "1234567890123",
                            "dDesProSer" => "Descripción del producto o servicio",
                            "cUniMed" => "1",
                            "dDesUniMed" => "Unidad de medida",
                            "dCantProSer" => 10,
                            "cPaisOrig" => "PRY",
                            "dDesPaisOrig" => "Paraguay",
                            "dInfItem" => "Información adicional del ítem",
                            "dCDCAnticipo" => "1234567890123456789012345678901234567890",
                            "dPUniProSer" => 10000,
                            "dTiCamIt" => 8000,
                            "dTotBruOpeItem" => 100000,
                            "dDescItem" => 10000,
                            "dPorcDesIt" => 10,
                            "dDescGloItem" => 0,
                            "dAntPreUniIt" => 0,
                            "dAntGloPreUniIt" => 0,
                            "dTotOpeItem" => 90000,
                            "dTotOpeGs" => 90000,
                            "iAfecIVA" => FormaAfectacionIVA::GRAVADO->value,
                            "dDesAfecIVA" => FormaAfectacionIVA::GRAVADO->getDescripcion(),
                            "dPropIVA" => 100,
                            "dTasaIVA" => 10,
                            "dBasGravIVA" => 9090,
                            "dLiqIVAItem" => 9090,
                        ],
                    ],
                    "iTipDocAso" => TipoDocumentoAsociado::ELECTRONICO->value,
                    "dDesTipDocAso" => TipoDocumentoAsociado::ELECTRONICO->getDescripcion(),
                    "dCdCDERef" => '01800782585001001000067622025011314272500570',
                ]
            ]]
        ];
    }

    #[DataProvider('dataProvider')]
    public function test_it_has_recep_de_tags($data)
    {
        $builder = new RecepDEBuilder();
        $director = new Director();
        $director->setBuilder($builder);
        $director->buildPayload($data);

        $result = $builder->getResult()->saveXML();
        $this->assertStringContainsString('<rEnviDe xmlns="http://ekuatia.set.gov.py/sifen/xsd">', $result);
        $this->assertStringContainsString('<dId>' . $data['dId'] . '</dId>', $result);
        $this->assertStringContainsString('<xDe>', $result);
    }

    #[DataProvider('dataProvider')]
    public function test_it_sends_recep_de_request($data)
    {
        try {
            $sifen = new Sifen(
                Host::PRODUCTION,
                $this->sifenCredential
            );

            $response = $sifen->enviarDE($data['dId'], $data['xDe']);

            $this->assertIsObject($response);

            // echo "\n✅ Respuesta:\n";
            // print_r($response);
        } catch (\Exception $e) {
            $this->fail('Error in response: ' . $e->getMessage());
        }
    }
}
