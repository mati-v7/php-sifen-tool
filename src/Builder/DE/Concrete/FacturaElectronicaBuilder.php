<?php

namespace Nyxcode\PhpSifenTool\Builder\DE\Concrete;

use DOMDocument;
use Nyxcode\PhpSifenTool\Builder\DE\BuilderInterface;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\DETag;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\GActEcoTag;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\GCamCondTag;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\GCamFETag;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\GCompPubTag;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\GCuotasTag;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\GDatGralOpeTag;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\GDatRecTag;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\GDTipDETag;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\GEmisTag;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\GOpeComTag;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\GOpeDETag;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\GPaConEIniTag;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\GPagCheqTag;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\GPagCredTag;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\GPagTarCDTag;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\GRespDETag;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\GTimbTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\CActEcoTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\CCiuEmiTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\CCiuRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\CDepEmiTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\CDepRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\CDisEmiTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\CDisRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\CMoneCuoTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\CMoneOpeTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\CMoneTiPagTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\CPaisRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\CTipRegTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DAnoContTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DBcoEmiTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DCarRespDETag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DCelRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DCodAuOpeTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DCodClienteTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DCodSegTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DCompDir1Tag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DCompDir2Tag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DCondTiCamTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DCuotasTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDCondCredTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDCondOpeTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDenSucTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesActEcoTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesCiuEmiTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesCiuRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesCondAntTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesDenTarjTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesDepEmiTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesDepRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesDisEmiTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesDisRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesIndPresTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesMoneOpeTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesPaisReTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesTiDETag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesTImpTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesTiPagTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesTipEmiTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesTipTraTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDirEmiTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDirRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDMoneCuoTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDMoneTiPagTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDTipIDRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDTipIDRespDETag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDVEmiTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDVIdTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDVProTarTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDVRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DEmailETag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DEmailRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DEntContTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DEstTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DFecFirmaTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DFeCodContTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DFeEmiDETag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DFeIniTTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DInfoEmiTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DInfoFiscTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DModContTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DMonCuotaTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DMonEntTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DMonTiPagTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DNomEmiTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DNomFanEmiTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DNomFanRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DNomRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DNomRespDETag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DNomTitTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DNumCasRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DNumCasTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DNumCheqTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DNumDocTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DNumIDRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DNumIDRespDETag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DNumTarjTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DNumTimTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DPlazoCreTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DPunExpTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DRSProTarTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DRucEmTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DRUCProTarTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DRucRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DSecContTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DSerieNumTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DSisFactTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DTelEmiTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DTelRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DTiCamTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DTiCamTiPagTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DVencCuoTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\ICondAntTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\ICondCredTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\ICondOpeTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\IDenTarjTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\IForProPaTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\IIndPresTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\INatRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\ITiContRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\ITiDETag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\ITImpTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\ITiOpeTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\ITiPagoTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\ITipContTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\ITipEmiTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\ITipIDRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\ITipIDRespDETag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\ITipTraTag;
use Nyxcode\PhpSifenTool\Enums\CondicionCredito;
use Nyxcode\PhpSifenTool\Enums\MonedaOperacion;
use Nyxcode\PhpSifenTool\Enums\NaturalezaReceptor;
use Nyxcode\PhpSifenTool\Enums\TipoCambioOperacion;
use Nyxcode\PhpSifenTool\Enums\TipoCondicionOperacion;
use Nyxcode\PhpSifenTool\Enums\TipoDocumentoElectronico;
use Nyxcode\PhpSifenTool\Enums\TipoOperacion;
use Nyxcode\PhpSifenTool\Enums\TipoPago;

class FacturaElectronicaBuilder implements BuilderInterface
{
    protected DOMDocument $doc;
    protected ITiDETag $iTiDE;
    protected DDesTiDETag $dDesTiDE;

    protected DETag $de;
    protected GDatGralOpeTag $gDatGralOpe;
    protected GEmisTag $gEmis;
    protected GDTipDETag $gDTipDE;
    protected GCamFETag $gCamFE;
    protected GCamCondTag $gCamCond;
    protected GPaConEIniTag $gPaConEIni;
    protected GPagCredTag $gPagCred;

    public function reset()
    {
        $this->doc = new DOMDocument(encoding: "UTF-8");
        $this->doc->formatOutput = true;

        $this->iTiDE = new ITiDETag(TipoDocumentoElectronico::FE->value);
        $this->dDesTiDE = new DDesTiDETag(TipoDocumentoElectronico::FE->getDescripcion());
    }

    /**
     * Grupo A
     */
    public function setGroupA($data)
    {
        $id = $data["Id"];
        $this->de = new DETag(attributes: ['Id' => $id]);

        $dDVId = new DDVIdTag($data["dDVId"]);
        $dFecFirma = new DFecFirmaTag($data["dFecFirma"]);
        $dSisFact = new DSisFactTag($data["dSisFact"]);

        $this->de->add($dDVId);
        $this->de->add($dFecFirma);
        $this->de->add($dSisFact);
    }

    /**
     * Grupo B
     */
    public function setGroupB($data)
    {
        $gOpeDE = new GOpeDETag();

        $iTipEmi = new ITipEmiTag($data["iTipEmi"]);
        $gOpeDE->add($iTipEmi);

        $dDesTipEmi = new DDesTipEmiTag($data["dDesTipEmi"]);
        $gOpeDE->add($dDesTipEmi);

        $dCodSeg = new DCodSegTag($data["dCodSeg"]);
        $gOpeDE->add($dCodSeg);

        if ($data["dInfoEmi"]) {
            $dInfoEmi = new DInfoEmiTag($data["dInfoEmi"]);
            $gOpeDE->add($dInfoEmi);
        }

        if ($data["dInfoFisc"]) {
            $dInfoFisc = new DInfoFiscTag($data["dInfoFisc"]);
            $gOpeDE->add($dInfoFisc);
        }
        $this->de->add($gOpeDE);
    }

    /**
     * Grupo C
     */
    public function setGroupC($data)
    {
        $gTimb = new GTimbTag();

        $gTimb->add($this->iTiDE);
        $gTimb->add($this->dDesTiDE);

        $dNumTim = new DNumTimTag($data["dNumTim"]);
        $gTimb->add($dNumTim);

        $dEst = new DEstTag($data["dEst"]);
        $gTimb->add($dEst);

        $dPunExp = new DPunExpTag($data["dPunExp"]);
        $gTimb->add($dPunExp);

        $dNumDoc = new DNumDocTag($data["dNumDoc"]);
        $gTimb->add($dNumDoc);

        if ($data["dSerieNum"]) {
            $dSerieNum = new DSerieNumTag($data["dSerieNum"]);
            $gTimb->add($dSerieNum);
        }

        $dFeIniT = new DFeIniTTag($data["dFeIniT"]);
        $gTimb->add($dFeIniT);

        $this->de->add($gTimb);
    }

    /**
     * Grupo D
     */
    public function setGroupD($data)
    {
        $this->gDatGralOpe = new GDatGralOpeTag();
        $dFeEmiDE = new DFeEmiDETag($data["dFeEmiDE"]);
        $this->gDatGralOpe->add($dFeEmiDE);
        $this->de->add($this->gDatGralOpe);
    }

    /**
     * Grupo D.1
     */
    public function setGroupD1($data)
    {
        $gOpeCom = new GOpeComTag();
        $iTipTra = new ITipTraTag($data["iTipTra"]);
        $gOpeCom->add($iTipTra);

        $dDesTipTra = new DDesTipTraTag($data["dDesTipTra"]);
        $gOpeCom->add($dDesTipTra);

        $iTImp = new ITImpTag($data["iTImp"]);
        $gOpeCom->add($iTImp);

        $dDesTImp = new DDesTImpTag($data["dDesTImp"]);
        $gOpeCom->add($dDesTImp);

        $cMoneOpe = new CMoneOpeTag($data["cMoneOpe"]);
        $gOpeCom->add($cMoneOpe);

        $dDesMoneOpe = new DDesMoneOpeTag($data["dDesMoneOpe"]);
        $gOpeCom->add($dDesMoneOpe);

        if ($cMoneOpe->getValue() != MonedaOperacion::PYG->value) {
            $dCondTiCam = new DCondTiCamTag($data["dCondTiCam"]);
            $gOpeCom->add($dCondTiCam);

            if ($dCondTiCam->getValue() == TipoCambioOperacion::GLOBAL->value) {
                $dTiCam = new DTiCamTag($data["dTiCam"]);
                $gOpeCom->add($dTiCam);
            }
        }

        if (
            $data["iCondAnt"] &&
            $data["dDesCondAnt"]
        ) {
            $iCondAnt = new ICondAntTag($data["iCondAnt"]);
            $gOpeCom->add($iCondAnt);

            $dDesCondAnt = new DDesCondAntTag($data["dDesCondAnt"]);
            $gOpeCom->add($dDesCondAnt);
        }
        $this->gDatGralOpe->add($gOpeCom);
    }

    /**
     * Grupo D.2
     */
    public function setGroupD2($data)
    {
        $gEmis = new GEmisTag();

        $dRucEm = new DRucEmTag($data["dRucEm"]);
        $gEmis->add($dRucEm);

        $dDVEmi = new DDVEmiTag($data["dDVEmi"]);
        $gEmis->add($dDVEmi);

        $iTipCont = new ITipContTag($data["iTipCont"]);
        $gEmis->add($iTipCont);

        if ($data["cTipReg"]) {
            $cTipReg = new CTipRegTag($data["cTipReg"]);
            $gEmis->add($cTipReg);
        }

        $dNomEmi = new DNomEmiTag($data["dNomEmi"]);
        $gEmis->add($dNomEmi);

        if ($data["dNomFanEmi"]) {
            $dNomFanEmi = new DNomFanEmiTag($data["dNomFanEmi"]);
            $gEmis->add($dNomFanEmi);
        }

        $dDirEmi = new DDirEmiTag($data["dDirEmi"]);
        $gEmis->add($dDirEmi);

        $dNumCas = new DNumCasTag($data["dNumCas"] ?? 0);
        $gEmis->add($dNumCas);

        if ($data["dCompDir1"]) {
            $dCompDir1 = new DCompDir1Tag($data["dCompDir1"]);
            $gEmis->add($dCompDir1);
        }

        if ($data["dCompDir2"]) {
            $dCompDir2 = new DCompDir2Tag($data["dCompDir2"]);
            $gEmis->add($dCompDir2);
        }

        $cDepEmi = new CDepEmiTag($data["cDepEmi"]);
        $gEmis->add($cDepEmi);

        $dDesDepEmi = new DDesDepEmiTag($data["dDesDepEmi"]);
        $gEmis->add($dDesDepEmi);

        if (
            $data["cDisEmi"] &&
            $data["dDesDisEmi"]
        ) {
            $cDisEmi = new CDisEmiTag($data["cDisEmi"]);
            $gEmis->add($cDisEmi);

            $dDesDisEmi = new DDesDisEmiTag($data["dDesDisEmi"]);
            $gEmis->add($dDesDisEmi);
        }

        $cCiuEmi = new CCiuEmiTag($data["cCiuEmi"]);
        $gEmis->add($cCiuEmi);

        $dDesCiuEmi = new DDesCiuEmiTag($data["dDesCiuEmi"]);
        $gEmis->add($dDesCiuEmi);

        $dTelEmi = new DTelEmiTag($data["dTelEmi"]);
        $gEmis->add($dTelEmi);

        $dEmailE = new DEmailETag($data["dEmailE"]);
        $gEmis->add($dEmailE);

        if ($data["dDenSuc"]) {
            $dDenSuc = new DDenSucTag($data["dDenSuc"]);
            $gEmis->add($dDenSuc);
        }

        $this->gEmis = $gEmis;

        foreach ($data["gActEco"] as $actEco) {
            $this->setGroupD21($actEco);
        }

        if (
            $data["iTipIDRespDE"] &&
            $data["dDTipIDRespDE"] &&
            $data["dNumIDRespDE"] &&
            $data["dNomRespDE"] &&
            $data["dCarRespDE"]
        ) {
            $this->setGroupD22($data);
        }

        $this->gDatGralOpe->add($this->gEmis);
    }

    /**
     * Grupo D.2.1
     */
    public function setGroupD21($data)
    {
        $gActEco = new GActEcoTag();

        $cActEco = new CActEcoTag($data["cActEco"]);
        $gActEco->add($cActEco);

        $dDesActEco = new DDesActEcoTag($data["dDesActEco"]);
        $gActEco->add($dDesActEco);
        $this->gEmis->add($gActEco);
    }

    /**
     * Grupo D.2.2
     */
    public function setGroupD22($data)
    {
        $gRespDE = new GRespDETag();

        $iTipIDRespDE = new ITipIDRespDETag($data["iTipIDRespDE"]);
        $gRespDE->add($iTipIDRespDE);

        $dDTipIDRespDE = new DDTipIDRespDETag($data["dDTipIDRespDE"]);
        $gRespDE->add($dDTipIDRespDE);

        $dNumIDRespDE = new DNumIDRespDETag($data["dNumIDRespDE"]);
        $gRespDE->add($dNumIDRespDE);

        $dNomRespDE = new DNomRespDETag($data["dNomRespDE"]);
        $gRespDE->add($dNomRespDE);

        $dCarRespDE = new DCarRespDETag($data["dCarRespDE"]);
        $gRespDE->add($dCarRespDE);

        $this->gEmis->add($gRespDE);
    }

    /**
     * Grupo D.3
     */
    public function setGroupD3($data)
    {
        $gDatRec = new GDatRecTag();

        $iNatRec = new INatRecTag($data["iNatRec"]);
        $gDatRec->add($iNatRec);

        $iTiOpe = new ITiOpeTag($data["iTiOpe"]);
        $gDatRec->add($iTiOpe);

        $cPaisRec = new CPaisRecTag($data["cPaisRec"]);
        $gDatRec->add($cPaisRec);

        $dDesPaisRe = new DDesPaisReTag($data["dDesPaisRe"]);
        $gDatRec->add($dDesPaisRe);

        if ($iNatRec->getValue() == NaturalezaReceptor::CONTRIBUYENTE->value) {
            $iTiContRec = new ITiContRecTag($data["iTiContRec"]);
            $gDatRec->add($iTiContRec);

            $dRucRec = new DRucRecTag($data["dRucRec"]);
            $gDatRec->add($dRucRec);

            $dDVRec = new DDVRecTag($data["dDVRec"]);
            $gDatRec->add($dDVRec);
        }

        if (
            $iNatRec->getValue() == NaturalezaReceptor::NO_CONTRIBUYENTE->value &&
            $iTiOpe->getValue() != TipoOperacion::B2F->value
        ) {
            $iTipIDRec = new ITipIDRecTag($data["iTipIDRec"]);
            $gDatRec->add($iTipIDRec);

            $dDTipIDRec = new DDTipIDRecTag($data["dDTipIDRec"]);
            $gDatRec->add($dDTipIDRec);

            $dNumIDRec = new DNumIDRecTag($data["dNumIDRec"]);
            $gDatRec->add($dNumIDRec);
        }

        $dNomRec = new DNomRecTag($data["dNomRec"]);
        $gDatRec->add($dNomRec);

        if ($data["dNomFacRec"]) {
            $dNomFacRec = new DNomFanRecTag($data["dNomFacRec"]);
            $gDatRec->add($dNomFacRec);
        }

        if (
            $data["dDirRec"] &&
            $data["dNumCasRec"]
        ) {
            $dDirRec = new DDirRecTag($data["dDirRec"]);
            $gDatRec->add($dDirRec);

            $dNumCasRec = new DNumCasRecTag($data["dNumCasRec"]);
            $gDatRec->add($dNumCasRec);



            if (
                $data["cDepRec"] &&
                $data["dDesDepRec"] &&
                $iTiOpe->getValue() != TipoOperacion::B2F->value
            ) {
                $cDepRec = new CDepRecTag($data["cDepRec"]);
                $gDatRec->add($cDepRec);

                $dDesDepRec = new DDesDepRecTag($data["dDesDepRec"]);
                $gDatRec->add($dDesDepRec);
            }

            if (
                $data["cDisRec"] &&
                $data["dDesDisRec"] &&
                $iTiOpe->getValue() != TipoOperacion::B2F->value
            ) {
                $cDisRec = new CDisRecTag($data["cDisRec"]);
                $gDatRec->add($cDisRec);

                $dDesDisRec = new DDesDisRecTag($data["dDesDisRec"]);
                $gDatRec->add($dDesDisRec);
            }

            if (
                $data["cCiuRec"] &&
                $data["dDesCiuRec"] &&
                $iTiOpe->getValue() != TipoOperacion::B2F->value
            ) {
                $cCiuRec = new CCiuRecTag($data["cCiuRec"]);
                $gDatRec->add($cCiuRec);

                $dDesCiuRec = new DDesCiuRecTag($data["dDesCiuRec"]);
                $gDatRec->add($dDesCiuRec);
            }
        }

        if ($data["dTelRec"]) {
            $dTelRec = new DTelRecTag($data["dTelRec"]);
            $gDatRec->add($dTelRec);
        }

        if ($data["dCelRec"]) {
            $dCelRec = new DCelRecTag($data["dCelRec"]);
            $gDatRec->add($dCelRec);
        }

        if ($data["dEmailRec"]) {
            $dEmailRec = new DEmailRecTag($data["dEmailRec"]);
            $gDatRec->add($dEmailRec);
        }

        if ($data["dCodCliente"]) {
            $dCodCliente = new DCodClienteTag($data["dCodCliente"]);
            $gDatRec->add($dCodCliente);
        }

        $this->gDatGralOpe->add($gDatRec);
    }

    public function setGroupE($data)
    {
        $this->gDTipDE = new GDTipDETag();

        /**
         * Grupo E.1
         */
        $this->setGroupE1($data);

        $this->de->add($this->gDTipDE);
    }

    public function setGroupE1($data)
    {
        $this->gCamFE = new GCamFETag();

        $iIndPres = new IIndPresTag($data["iIndPres"]);
        $this->gCamFE->add($iIndPres);

        $dDesIndPres = new DDesIndPresTag($data["dDesIndPres"]);
        $this->gCamFE->add($dDesIndPres);

        if ($data["dFecEmNR"]) {
            $dFecEmNR = new DFeEmiDETag($data["dFecEmNR"]);
            $this->gCamFE->add($dFecEmNR);
        }

        if (
            $data["dModCont"] &&
            $data["dEntCont"] &&
            $data["dAnoCont"] &&
            $data["dSecCont"] &&
            $data["dFeCodCont"] &&
            $data["iTiOpe"] == TipoOperacion::B2G->value
        ) {
            $this->setGroupE11($data);
        }

        $this->gDTipDE->add($this->gCamFE);

        $this->setGroupE7($data);
    }

    public function setGroupE11($data)
    {
        $gCompPub = new GCompPubTag();

        $dModCont = new DModContTag($data["dModCont"]);
        $gCompPub->add($dModCont);

        $dEntCont = new DEntContTag($data["dEntCont"]);
        $gCompPub->add($dEntCont);

        $dAnoCont = new DAnoContTag($data["dAnoCont"]);
        $gCompPub->add($dAnoCont);

        $dSecCont = new DSecContTag($data["dSecCont"]);
        $gCompPub->add($dSecCont);

        $dFeCodCont = new DFeCodContTag($data["dFeCodCont"]);
        $gCompPub->add($dFeCodCont);

        $this->gCamFE->add($gCompPub);
    }

    public function setGroupE7($data)
    {
        $this->gCamCond = new GCamCondTag();

        $iCondOpe = new ICondOpeTag($data["iCondOpe"]);
        $this->gCamCond->add($iCondOpe);

        $dDCondOpe = new DDCondOpeTag($data["dDCondOpe"]);
        $this->gCamCond->add($dDCondOpe);

        if ($data["iCondOpe"] == TipoCondicionOperacion::CONTADO->value) {
            foreach ($data["gPaConEIni"] as $gPaConEIni) {
                $this->setGroupE71($gPaConEIni);
            }
        }

        if ($data["iCondOpe"] == TipoCondicionOperacion::CREDITO->value) {
            $this->setGroupE72($data);
        }

        $this->gDTipDE->add($this->gCamCond);
    }

    public function setGroupE71($data)
    {
        $this->gPaConEIni = new GPaConEIniTag();

        $iTiPago = new ITiPagoTag($data["iTiPago"]);
        $this->gPaConEIni->add($iTiPago);

        $dDesTiPag = new DDesTiPagTag($data["dDesTiPag"]);
        $this->gPaConEIni->add($dDesTiPag);

        $dMonTiPag = new DMonTiPagTag($data["dMonTiPag"]);
        $this->gPaConEIni->add($dMonTiPag);

        $cMoneTiPag = new CMoneTiPagTag($data["cMoneTiPag"]);
        $this->gPaConEIni->add($cMoneTiPag);

        $dDMoneTiPag = new DDMoneTiPagTag($data["dDMoneTiPag"]);
        $this->gPaConEIni->add($dDMoneTiPag);

        if (
            $data["dTiCamTiPag"] &&
            $data["cMoneTiPag"] != MonedaOperacion::PYG->value
        ) {
            $dTiCamTiPag = new DTiCamTiPagTag($data["dTiCamTiPag"]);
            $this->gPaConEIni->add($dTiCamTiPag);
        }

        if (
            $data["iTiPago"] == TipoPago::TARJETA_CREDITO->value ||
            $data["iTiPago"] == TipoPago::TARJETA_DEBITO->value
        ) {
            $this->setGroupE711($data);
        }

        if (
            $data["iTiPago"] == TipoPago::CHEQUE->value &&
            !empty($data["dNumCheq"]) &&
            !empty($data["dBcoEmi"])
        ) {
            $this->setGroupE712($data);
        }

        $this->gCamCond->add($this->gPaConEIni);
    }

    public function setGroupE711($data)
    {
        $gPagTarCD = new GPagTarCDTag();

        $iDenTarj = new IDenTarjTag($data["iDenTarj"]);
        $gPagTarCD->add($iDenTarj);

        $dDesDenTarj = new DDesDenTarjTag($data["dDesDenTarj"]);
        $gPagTarCD->add($dDesDenTarj);

        if ($data["dRSProTar"]) {
            $dRSProTar = new DRSProTarTag($data["dRSProTar"]);
            $gPagTarCD->add($dRSProTar);
        }

        if (
            isset($data["dRUCProTar"]) &&
            isset($data["dDVProTar"])
        ) {
            $dRUCProTar = new DRUCProTarTag($data["dRUCProTar"]);
            $gPagTarCD->add($dRUCProTar);

            $dDVProTar = new DDVProTarTag($data["dDVProTar"]);
            $gPagTarCD->add($dDVProTar);
        }

        $iForProPa = new IForProPaTag($data["iForProPa"]);
        $gPagTarCD->add($iForProPa);

        if ($data["dCodAuOpe"]) {
            $dCodAuOpe = new DCodAuOpeTag($data["dCodAuOpe"]);
            $gPagTarCD->add($dCodAuOpe);
        }

        if ($data["dNomTit"]) {
            $dNomTit = new DNomTitTag($data["dNomTit"]);
            $gPagTarCD->add($dNomTit);
        }

        if ($data["dNumTarj"]) {
            $dNumTarj = new DNumTarjTag($data["dNumTarj"]);
            $gPagTarCD->add($dNumTarj);
        }

        $this->gPaConEIni->add($gPagTarCD);
    }

    public function setGroupE712($data)
    {
        $gPagCheq = new GPagCheqTag();

        $dNumCheq = new DNumCheqTag($data["dNumCheq"]);
        $gPagCheq->add($dNumCheq);

        $dBcoEmi = new DBcoEmiTag($data["dBcoEmi"]);
        $gPagCheq->add($dBcoEmi);

        $this->gPaConEIni->add($gPagCheq);
    }

    public function setGroupE72($data)
    {
        $this->gPagCred = new GPagCredTag();

        $iCondCred = new ICondCredTag($data["iCondCred"]);
        $this->gPagCred->add($iCondCred);

        $dDCondCred = new DDCondCredTag($data["dDCondCred"]);
        $this->gPagCred->add($dDCondCred);

        if ($iCondCred->getValue() == CondicionCredito::PLAZO->value) {
            $dPlazoCre = new DPlazoCreTag($data["dPlazoCre"]);
            $this->gPagCred->add($dPlazoCre);
        }

        if ($iCondCred->getValue() == CondicionCredito::CUOTA->value) {
            $dCuotas = new DCuotasTag($data["dCuotas"]);
            $this->gPagCred->add($dCuotas);
        }

        if ($data["dMonEnt"]) {
            $dMonEnt = new DMonEntTag($data["dMonEnt"]);
            $this->gPagCred->add($dMonEnt);
        }

        if ($iCondCred->getValue() == CondicionCredito::CUOTA->value) {
            foreach ($data["gCuotas"] as $gCuota) {
                $this->setGroupE721($gCuota);
            }
        }

        $this->gCamCond->add($this->gPagCred);
    }

    public function setGroupE721($data)
    {
        $gCuotas = new GCuotasTag();

        $cMoneCuo = new CMoneCuoTag($data["cMoneCuo"]);
        $gCuotas->add($cMoneCuo);

        $dDMoneCuo = new DDMoneCuoTag($data["dDMoneCuo"]);
        $gCuotas->add($dDMoneCuo);

        $dMonCuota = new DMonCuotaTag($data["dMonCuota"]);
        $gCuotas->add($dMonCuota);

        if ($data["dVencCuo"]) {
            $dVencCuo = new DVencCuoTag($data["dVencCuo"]);
            $gCuotas->add($dVencCuo);
        }

        $this->gPagCred->add($gCuotas);
    }

    public function getResult()
    {
        $this->de->render($this->doc);
        return $this->doc->saveXML();
    }
}
