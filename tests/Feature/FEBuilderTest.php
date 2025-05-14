<?php

namespace Nyxcode\PhpSifenTool\Tests\Feature;

use DateTime;
use Nyxcode\PhpSifenTool\Builder\DE\Concrete\DocumentoElectronicoBuilder;
use Nyxcode\PhpSifenTool\Builder\DE\Concrete\FacturaElectronicaBuilder;
use Nyxcode\PhpSifenTool\Builder\DE\Director;
use Nyxcode\PhpSifenTool\Enums\DenominacionTarjeta;
use Nyxcode\PhpSifenTool\Enums\FormaProcesamientoTarjeta;
use Nyxcode\PhpSifenTool\Enums\IndicadorPresencia;
use Nyxcode\PhpSifenTool\Enums\MonedaOperacion;
use Nyxcode\PhpSifenTool\Enums\NaturalezaReceptor;
use Nyxcode\PhpSifenTool\Enums\SistemaFacturacion;
use Nyxcode\PhpSifenTool\Enums\TipoCambioOperacion;
use Nyxcode\PhpSifenTool\Enums\TipoCondicionAnticipo;
use Nyxcode\PhpSifenTool\Enums\TipoCondicionOperacion;
use Nyxcode\PhpSifenTool\Enums\TipoContribuyente;
use Nyxcode\PhpSifenTool\Enums\TipoDocumentoReceptor;
use Nyxcode\PhpSifenTool\Enums\TipoEmision;
use Nyxcode\PhpSifenTool\Enums\TipoImpuesto;
use Nyxcode\PhpSifenTool\Enums\TipoOperacion;
use Nyxcode\PhpSifenTool\Enums\TipoPago;
use Nyxcode\PhpSifenTool\Enums\TipoRegimen;
use Nyxcode\PhpSifenTool\Enums\TipoTransaccion;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class FEBuilderTest extends TestCase
{

    public static function dataProvider(): array
    {
        return [
            ["data" => [
                "Id" => "1234567890",
                "dDVId" => "0987654321",
                "dFecFirma" => (new DateTime())->format(DateTime::ATOM),
                "dSisFact" => SistemaFacturacion::CONTRIBUYENTE->value,
                "iTipEmi" => TipoEmision::NORMAL->value,
                "dDesTipEmi" => TipoEmision::NORMAL->getDescripcion(),
                "dCodSeg" => 123456789,
                "dInfoEmi" => "Información de interés del emisor respecto al DE",
                "dInfoFisc" => "Información de interés del Fisco respecto al DE",
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
                "iTiOpe" => TipoOperacion::B2G->value,
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
                "iCondOpe" => TipoCondicionOperacion::CONTADO->value,
                "dDCondOpe" => TipoCondicionOperacion::CONTADO->getDescripcion(),
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
                ]
            ]]
        ];
    }

    #[DataProvider('dataProvider')]
    public function test_build_fe_de($data)
    {
        $builder = new FacturaElectronicaBuilder();
        $director = new Director();

        $director->setBuilder($builder);
        $director->buildFacturaElectronica($data);

        $product = $builder->getResult();
        $this->assertNotEmpty($product, 'Producto XML vacio');

        print $product;
    }
}
