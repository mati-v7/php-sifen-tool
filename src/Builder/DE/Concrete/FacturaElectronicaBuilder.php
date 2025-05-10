<?php

namespace Nyxcode\PhpSifenTool\Builder\DE\Concrete;

use DOMDocument;
use Nyxcode\PhpSifenTool\Builder\DE\BuilderInterface;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\DETag;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\GActEcoTag;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\GCamCondTag;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\GCamFETag;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\GCompPubTag;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\GDatGralOpeTag;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\GDatRecTag;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\GDTipDETag;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\GEmisTag;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\GOpeComTag;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\GOpeDETag;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\GRespDETag;
use Nyxcode\PhpSifenTool\Composite\Concrete\DE\GTimbTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\CActEcoTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\CCiuEmiTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\CCiuRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\CDepEmiTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\CDepRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\CDisEmiTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\CDisRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\CMoneOpeTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\CPaisRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\CTipRegTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DAnoContTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DCarRespDETag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DCelRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DCodClienteTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DCodSegTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DCompDir1Tag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DCompDir2Tag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DCondTiCamTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDCondOpeTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDenSucTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesActEcoTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesCiuEmiTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesCiuRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesCondAntTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesDepEmiTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesDepRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesDisEmiTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesDisRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesIndPresTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesMoneOpeTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesPaisReTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesTiDETag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesTImpTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesTipEmiTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDesTipTraTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDirEmiTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDirRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDTipIDRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDTipIDRespDETag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDVEmiTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DDVIdTag;
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
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DNomEmiTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DNomFanEmiTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DNomFanRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DNomRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DNomRespDETag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DNumCasRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DNumCasTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DNumDocTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DNumIDRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DNumIDRespDETag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DNumTimTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DPunExpTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DRucEmTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DRucRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DSecContTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DSerieNumTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DSisFactTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DTelEmiTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DTelRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\DTiCamTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\ICondAntTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\ICondOpeTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\IIndPresTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\INatRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\ITiContRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\ITiDETag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\ITImpTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\ITiOpeTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\ITipContTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\ITipEmiTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\ITipIDRecTag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\ITipIDRespDETag;
use Nyxcode\PhpSifenTool\Composite\Leaf\DE\ITipTraTag;
use Nyxcode\PhpSifenTool\Enums\MonedaOperacion;
use Nyxcode\PhpSifenTool\Enums\NaturalezaReceptor;
use Nyxcode\PhpSifenTool\Enums\TipoCambioOperacion;
use Nyxcode\PhpSifenTool\Enums\TipoDocumentoElectronico;
use Nyxcode\PhpSifenTool\Enums\TipoOperacion;

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
        $gCamCond = new GCamCondTag();

        $iCondOpe = new ICondOpeTag($data["iCondOpe"]);
        $gCamCond->add($iCondOpe);

        $dDCondOpe = new DDCondOpeTag($data["dDCondOpe"]);
        $gCamCond->add($dDCondOpe);

        $this->gDTipDE->add($gCamCond);
    }

    public function getResult()
    {
        $this->de->render($this->doc);
        return $this->doc->saveXML();
    }
}
