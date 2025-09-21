<?php

namespace Nyxcode\PhpSifenTool\Builder\DE\Concrete;

use DOMDocument;
use Nyxcode\PhpSifenTool\Builder\DE\BuilderInterface;
use Nyxcode\PhpSifenTool\Composite\TagComposite;
use Nyxcode\PhpSifenTool\Composite\TagLeaf;
use Nyxcode\PhpSifenTool\Enums\DE\CondicionCredito;
use Nyxcode\PhpSifenTool\Enums\DE\MonedaOperacion;
use Nyxcode\PhpSifenTool\Enums\DE\NaturalezaReceptor;
use Nyxcode\PhpSifenTool\Enums\DE\TipoCambioOperacion;
use Nyxcode\PhpSifenTool\Enums\DE\TipoCondicionOperacion;
use Nyxcode\PhpSifenTool\Enums\DE\TipoConstancia;
use Nyxcode\PhpSifenTool\Enums\DE\TipoDocumentoAsociado;
use Nyxcode\PhpSifenTool\Enums\DE\TipoDocumentoElectronico;
use Nyxcode\PhpSifenTool\Enums\DE\TipoOperacion;
use Nyxcode\PhpSifenTool\Enums\DE\TipoPago;
use Nyxcode\PhpSifenTool\Enums\DE\TipoTransaccion;
use Nyxcode\PhpSifenTool\Enums\Tag\DE;

class FacturaElectronicaBuilder implements BuilderInterface
{
    protected DOMDocument $doc;

    protected TagComposite $de;
    protected TagComposite $gOpeDE;
    protected TagComposite $gTimb;
    protected TagComposite $gDatGralOpe;
    protected TagComposite $gOpeCom;
    protected TagComposite $gEmis;
    protected TagComposite $gDatRec;
    protected TagComposite $gDTipDE;
    protected TagComposite $gCamFE;
    protected TagComposite $gCamCond;
    protected TagComposite $gPaConEIni;
    protected TagComposite $gPagCred;
    protected TagComposite $gCamItem;
    protected TagComposite $gValorItem;
    protected TagComposite $gTotSub;
    protected TagComposite $gCamDEAsoc;
    protected TagLeaf $iTiDE;
    protected TagLeaf $dDesTiDE;

    public function reset()
    {
        $this->doc = new DOMDocument(encoding: "UTF-8");
        $this->doc->formatOutput = true;

        $this->iTiDE = new TagLeaf(DE::I_TI_DE, TipoDocumentoElectronico::FE->value);
        $this->dDesTiDE = new TagLeaf(DE::D_DES_TI_DE, TipoDocumentoElectronico::FE->getDescripcion());
    }

    /**
     * Grupo A
     */
    public function setGroupA($data)
    {
        $id = $data["Id"];
        $this->de = new TagComposite(DE::DE, attributes: ['Id' => $id]);

        $dDVId = new TagLeaf(DE::D_DV_ID, $data["dDVId"]);
        $dFecFirma = new TagLeaf(DE::D_FEC_FIRMA, $data["dFecFirma"]);
        $dSisFact = new TagLeaf(DE::D_SIS_FACT, $data["dSisFact"]);

        $this->de->add($dDVId);
        $this->de->add($dFecFirma);
        $this->de->add($dSisFact);
    }

    /**
     * Grupo B
     */
    public function setGroupB($data)
    {
        $this->gOpeDE = new TagComposite(DE::G_OPE_DE);

        $iTipEmi = new TagLeaf(DE::I_TIP_EMI, $data["iTipEmi"]);
        $this->gOpeDE->add($iTipEmi);

        $dDesTipEmi = new TagLeaf(DE::D_DES_TIP_EMI, $data["dDesTipEmi"]);
        $this->gOpeDE->add($dDesTipEmi);

        $dCodSeg = new TagLeaf(DE::D_COD_SEG, $data["dCodSeg"]);
        $this->gOpeDE->add($dCodSeg);

        if ($data["dInfoEmi"]) {
            $dInfoEmi = new TagLeaf(DE::D_INFO_EMI, $data["dInfoEmi"]);
            $this->gOpeDE->add($dInfoEmi);
        }

        if ($data["dInfoFisc"]) {
            $dInfoFisc = new TagLeaf(DE::D_INFO_FISC, $data["dInfoFisc"]);
            $this->gOpeDE->add($dInfoFisc);
        }
        $this->de->add($this->gOpeDE);
    }

    /**
     * Grupo C
     */
    public function setGroupC($data)
    {
        $this->gTimb = new TagComposite(DE::G_TIMB);

        $this->gTimb->add($this->iTiDE);
        $this->gTimb->add($this->dDesTiDE);

        $dNumTim = new TagLeaf(DE::D_NUM_TIM, $data["dNumTim"]);
        $this->gTimb->add($dNumTim);

        $dEst = new TagLeaf(DE::D_EST, $data["dEst"]);
        $this->gTimb->add($dEst);

        $dPunExp = new TagLeaf(DE::D_PUN_EXP, $data["dPunExp"]);
        $this->gTimb->add($dPunExp);

        $dNumDoc = new TagLeaf(DE::D_NUM_DOC, $data["dNumDoc"]);
        $this->gTimb->add($dNumDoc);

        if ($data["dSerieNum"]) {
            $dSerieNum = new TagLeaf(DE::D_SERIE_NUM, $data["dSerieNum"]);
            $this->gTimb->add($dSerieNum);
        }

        $dFeIniT = new TagLeaf(DE::D_FE_INI_T, $data["dFeIniT"]);
        $this->gTimb->add($dFeIniT);

        $this->de->add($this->gTimb);
    }

    /**
     * Grupo D
     */
    public function setGroupD($data)
    {
        $this->gDatGralOpe = new TagComposite(DE::G_DAT_GRAL_OPE);
        $dFeEmiDE = new TagLeaf(DE::D_FE_EMI_DE, $data["dFeEmiDE"]);
        $this->gDatGralOpe->add($dFeEmiDE);
        $this->de->add($this->gDatGralOpe);
    }

    /**
     * Grupo D.1
     */
    public function setGroupD1($data)
    {
        $this->gOpeCom = new TagComposite(DE::G_OPE_COM);
        $iTipTra = new TagLeaf(DE::I_TIP_TRA, $data["iTipTra"]);
        $this->gOpeCom->add($iTipTra);

        $dDesTipTra = new TagLeaf(DE::D_DES_TIP_TRA, $data["dDesTipTra"]);
        $this->gOpeCom->add($dDesTipTra);

        $iTImp = new TagLeaf(DE::I_T_IMP, $data["iTImp"]);
        $this->gOpeCom->add($iTImp);

        $dDesTImp = new TagLeaf(DE::D_DES_T_IMP, $data["dDesTImp"]);
        $this->gOpeCom->add($dDesTImp);

        $cMoneOpe = new TagLeaf(DE::C_MONE_OPE, $data["cMoneOpe"]);
        $this->gOpeCom->add($cMoneOpe);

        $dDesMoneOpe = new TagLeaf(DE::D_DES_MONE_OPE, $data["dDesMoneOpe"]);
        $this->gOpeCom->add($dDesMoneOpe);

        if ($cMoneOpe->getValue() != MonedaOperacion::PYG->value) {
            $dCondTiCam = new TagLeaf(DE::D_COND_TI_CAM, $data["dCondTiCam"]);
            $this->gOpeCom->add($dCondTiCam);

            if ($dCondTiCam->getValue() == TipoCambioOperacion::GLOBAL->value) {
                $dTiCam = new TagLeaf(DE::D_TI_CAM, $data["dTiCam"]);
                $this->gOpeCom->add($dTiCam);
            }
        }

        if (
            $data["iCondAnt"] &&
            $data["dDesCondAnt"]
        ) {
            $iCondAnt = new TagLeaf(DE::I_COND_ANT, $data["iCondAnt"]);
            $this->gOpeCom->add($iCondAnt);

            $dDesCondAnt = new TagLeaf(DE::D_DES_COND_ANT, $data["dDesCondAnt"]);
            $this->gOpeCom->add($dDesCondAnt);
        }
        $this->gDatGralOpe->add($this->gOpeCom);
    }

    /**
     * Grupo D.2
     */
    public function setGroupD2($data)
    {
        $gEmis = new TagComposite(DE::G_EMIS);

        $dRucEm = new TagLeaf(DE::D_RUC_EM, $data["dRucEm"]);
        $gEmis->add($dRucEm);

        $dDVEmi = new TagLeaf(DE::D_DV_EMI, $data["dDVEmi"]);
        $gEmis->add($dDVEmi);

        $iTipCont = new TagLeaf(DE::I_TIP_CONT, $data["iTipCont"]);
        $gEmis->add($iTipCont);

        if ($data["cTipReg"]) {
            $cTipReg = new TagLeaf(DE::C_TIP_REG, $data["cTipReg"]);
            $gEmis->add($cTipReg);
        }

        $dNomEmi = new TagLeaf(DE::D_NOM_EMI, $data["dNomEmi"]);
        $gEmis->add($dNomEmi);

        if ($data["dNomFanEmi"]) {
            $dNomFanEmi = new TagLeaf(DE::D_NOM_FAN_EMI, $data["dNomFanEmi"]);
            $gEmis->add($dNomFanEmi);
        }

        $dDirEmi = new TagLeaf(DE::D_DIR_EMI, $data["dDirEmi"]);
        $gEmis->add($dDirEmi);

        $dNumCas = new TagLeaf(DE::D_NUM_CAS, $data["dNumCas"] ?? 0);
        $gEmis->add($dNumCas);

        if ($data["dCompDir1"]) {
            $dCompDir1 = new TagLeaf(DE::D_COMP_DIR1, $data["dCompDir1"]);
            $gEmis->add($dCompDir1);
        }

        if ($data["dCompDir2"]) {
            $dCompDir2 = new TagLeaf(DE::D_COMP_DIR2, $data["dCompDir2"]);
            $gEmis->add($dCompDir2);
        }

        $cDepEmi = new TagLeaf(DE::C_DEP_EMI, $data["cDepEmi"]);
        $gEmis->add($cDepEmi);

        $dDesDepEmi = new TagLeaf(DE::D_DES_DEP_EMI, $data["dDesDepEmi"]);
        $gEmis->add($dDesDepEmi);

        if (
            $data["cDisEmi"] &&
            $data["dDesDisEmi"]
        ) {
            $cDisEmi = new TagLeaf(DE::C_DIS_EMI, $data["cDisEmi"]);
            $gEmis->add($cDisEmi);

            $dDesDisEmi = new TagLeaf(DE::D_DES_DIS_EMI, $data["dDesDisEmi"]);
            $gEmis->add($dDesDisEmi);
        }

        $cCiuEmi = new TagLeaf(DE::C_CIU_EMI, $data["cCiuEmi"]);
        $gEmis->add($cCiuEmi);

        $dDesCiuEmi = new TagLeaf(DE::D_DES_CIU_EMI, $data["dDesCiuEmi"]);
        $gEmis->add($dDesCiuEmi);

        $dTelEmi = new TagLeaf(DE::D_TEL_EMI, $data["dTelEmi"]);
        $gEmis->add($dTelEmi);

        $dEmailE = new TagLeaf(DE::D_EMAIL_E, $data["dEmailE"]);
        $gEmis->add($dEmailE);

        if ($data["dDenSuc"]) {
            $dDenSuc = new TagLeaf(DE::D_DEN_SUC, $data["dDenSuc"]);
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
        $gActEco = new TagComposite(DE::C_ACT_ECO);

        $cActEco = new TagLeaf(DE::C_ACT_ECO, $data["cActEco"]);
        $gActEco->add($cActEco);

        $dDesActEco = new TagLeaf(DE::D_DES_ACT_ECO, $data["dDesActEco"]);
        $gActEco->add($dDesActEco);
        $this->gEmis->add($gActEco);
    }

    /**
     * Grupo D.2.2
     */
    public function setGroupD22($data)
    {
        $gRespDE = new TagComposite(DE::G_RESP_DE);

        $iTipIDRespDE = new TagLeaf(DE::I_TIP_ID_RESP_DE, $data["iTipIDRespDE"]);
        $gRespDE->add($iTipIDRespDE);

        $dDTipIDRespDE = new TagLeaf(DE::D_D_TIP_ID_RESP_DE, $data["dDTipIDRespDE"]);
        $gRespDE->add($dDTipIDRespDE);

        $dNumIDRespDE = new TagLeaf(DE::D_NUM_ID_RESP_DE, $data["dNumIDRespDE"]);
        $gRespDE->add($dNumIDRespDE);

        $dNomRespDE = new TagLeaf(DE::D_NOM_RESP_DE, $data["dNomRespDE"]);
        $gRespDE->add($dNomRespDE);

        $dCarRespDE = new TagLeaf(DE::D_CAR_RESP_DE, $data["dCarRespDE"]);
        $gRespDE->add($dCarRespDE);

        $this->gEmis->add($gRespDE);
    }

    /**
     * Grupo D.3
     */
    public function setGroupD3($data)
    {
        $this->gDatRec = new TagComposite(DE::G_DAT_REC);

        $iNatRec = new TagLeaf(DE::I_NAT_REC, $data["iNatRec"]);
        $this->gDatRec->add($iNatRec);

        $iTiOpe = new TagLeaf(DE::I_TI_OPE, $data["iTiOpe"]);
        $this->gDatRec->add($iTiOpe);

        $cPaisRec = new TagLeaf(DE::C_PAIS_REC, $data["cPaisRec"]);
        $this->gDatRec->add($cPaisRec);

        $dDesPaisRe = new TagLeaf(DE::D_DES_PAIS_RE, $data["dDesPaisRe"]);
        $this->gDatRec->add($dDesPaisRe);

        if ($iNatRec->getValue() == NaturalezaReceptor::CONTRIBUYENTE->value) {
            $iTiContRec = new TagLeaf(DE::I_TI_CONT_REC, $data["iTiContRec"]);
            $this->gDatRec->add($iTiContRec);

            $dRucRec = new TagLeaf(DE::D_RUC_REC, $data["dRucRec"]);
            $this->gDatRec->add($dRucRec);

            $dDVRec = new TagLeaf(DE::D_DV_REC, $data["dDVRec"]);
            $this->gDatRec->add($dDVRec);
        }

        if (
            $iNatRec->getValue() == NaturalezaReceptor::NO_CONTRIBUYENTE->value &&
            $iTiOpe->getValue() != TipoOperacion::B2F->value
        ) {
            $iTipIDRec = new TagLeaf(DE::I_TIP_ID_REC, $data["iTipIDRec"]);
            $this->gDatRec->add($iTipIDRec);

            $dDTipIDRec = new TagLeaf(DE::D_D_TIP_ID_REC, $data["dDTipIDRec"]);
            $this->gDatRec->add($dDTipIDRec);

            $dNumIDRec = new TagLeaf(DE::D_NUM_ID_REC, $data["dNumIDRec"]);
            $this->gDatRec->add($dNumIDRec);
        }

        $dNomRec = new TagLeaf(DE::D_NOM_REC, $data["dNomRec"]);
        $this->gDatRec->add($dNomRec);

        if ($data["dNomFacRec"]) {
            $dNomFacRec = new TagLeaf(DE::D_NOM_FAN_REC, $data["dNomFacRec"]);
            $this->gDatRec->add($dNomFacRec);
        }

        if (
            $data["dDirRec"] &&
            $data["dNumCasRec"]
        ) {
            $dDirRec = new TagLeaf(DE::D_DIR_REC, $data["dDirRec"]);
            $this->gDatRec->add($dDirRec);

            $dNumCasRec = new TagLeaf(DE::D_NUM_CAS_REC, $data["dNumCasRec"]);
            $this->gDatRec->add($dNumCasRec);



            if (
                $data["cDepRec"] &&
                $data["dDesDepRec"] &&
                $iTiOpe->getValue() != TipoOperacion::B2F->value
            ) {
                $cDepRec = new TagLeaf(DE::C_DEP_REC, $data["cDepRec"]);
                $this->gDatRec->add($cDepRec);

                $dDesDepRec = new TagLeaf(DE::D_DES_DEP_REC, $data["dDesDepRec"]);
                $this->gDatRec->add($dDesDepRec);
            }

            if (
                $data["cDisRec"] &&
                $data["dDesDisRec"] &&
                $iTiOpe->getValue() != TipoOperacion::B2F->value
            ) {
                $cDisRec = new TagLeaf(DE::C_DIS_REC, $data["cDisRec"]);
                $this->gDatRec->add($cDisRec);

                $dDesDisRec = new TagLeaf(DE::D_DES_DIS_REC, $data["dDesDisRec"]);
                $this->gDatRec->add($dDesDisRec);
            }

            if (
                $data["cCiuRec"] &&
                $data["dDesCiuRec"] &&
                $iTiOpe->getValue() != TipoOperacion::B2F->value
            ) {
                $cCiuRec = new TagLeaf(DE::C_CIU_REC, $data["cCiuRec"]);
                $this->gDatRec->add($cCiuRec);

                $dDesCiuRec = new TagLeaf(DE::D_DES_CIU_REC, $data["dDesCiuRec"]);
                $this->gDatRec->add($dDesCiuRec);
            }
        }

        if ($data["dTelRec"]) {
            $dTelRec = new TagLeaf(DE::D_TEL_REC, $data["dTelRec"]);
            $this->gDatRec->add($dTelRec);
        }

        if ($data["dCelRec"]) {
            $dCelRec = new TagLeaf(DE::D_CEL_REC, $data["dCelRec"]);
            $this->gDatRec->add($dCelRec);
        }

        if ($data["dEmailRec"]) {
            $dEmailRec = new TagLeaf(DE::D_EMAIL_REC, $data["dEmailRec"]);
            $this->gDatRec->add($dEmailRec);
        }

        if ($data["dCodCliente"]) {
            $dCodCliente = new TagLeaf(DE::D_COD_CLIENTE, $data["dCodCliente"]);
            $this->gDatRec->add($dCodCliente);
        }

        $this->gDatGralOpe->add($this->gDatRec);
    }

    public function setGroupE($data)
    {
        $this->gDTipDE = new TagComposite(DE::G_D_TIP_DE);

        /**
         * Grupo E.1
         */
        $this->setGroupE1($data);

        $this->de->add($this->gDTipDE);
    }

    public function setGroupE1($data)
    {
        $this->gCamFE = new TagComposite(DE::G_CAM_FE);

        $iIndPres = new TagLeaf(DE::I_IND_PRES, $data["iIndPres"]);
        $this->gCamFE->add($iIndPres);

        $dDesIndPres = new TagLeaf(DE::D_DES_IND_PRES, $data["dDesIndPres"]);
        $this->gCamFE->add($dDesIndPres);

        if ($data["dFecEmNR"]) {
            $dFecEmNR = new TagLeaf(DE::D_FEC_EM_NR, $data["dFecEmNR"]);
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

        foreach ($data["gCamItem"] as $gCamItem) {
            $this->setGroupE8($gCamItem);
        }
    }

    public function setGroupE11($data)
    {
        $gCompPub = new TagComposite(DE::G_COMP_PUB);

        $dModCont = new TagLeaf(DE::D_MOD_CONT, $data["dModCont"]);
        $gCompPub->add($dModCont);

        $dEntCont = new TagLeaf(DE::D_ENT_CONT, $data["dEntCont"]);
        $gCompPub->add($dEntCont);

        $dAnoCont = new TagLeaf(DE::D_ANO_CONT, $data["dAnoCont"]);
        $gCompPub->add($dAnoCont);

        $dSecCont = new TagLeaf(DE::D_SEC_CONT, $data["dSecCont"]);
        $gCompPub->add($dSecCont);

        $dFeCodCont = new TagLeaf(DE::D_FE_COD_CONT, $data["dFeCodCont"]);
        $gCompPub->add($dFeCodCont);

        $this->gCamFE->add($gCompPub);
    }

    public function setGroupE7($data)
    {
        $this->gCamCond = new TagComposite(DE::G_CAM_COND);

        $iCondOpe = new TagLeaf(DE::I_COND_OPE, $data["iCondOpe"]);
        $this->gCamCond->add($iCondOpe);

        $dDCondOpe = new TagLeaf(DE::D_D_COND_OPE, $data["dDCondOpe"]);
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
        $this->gPaConEIni = new TagComposite(DE::G_PA_CON_E_INI);

        $iTiPago = new TagLeaf(DE::I_TI_PAGO, $data["iTiPago"]);
        $this->gPaConEIni->add($iTiPago);

        $dDesTiPag = new TagLeaf(DE::D_DES_TI_PAG, $data["dDesTiPag"]);
        $this->gPaConEIni->add($dDesTiPag);

        $dMonTiPag = new TagLeaf(DE::D_MON_TI_PAG, $data["dMonTiPag"]);
        $this->gPaConEIni->add($dMonTiPag);

        $cMoneTiPag = new TagLeaf(DE::C_MONE_TI_PAG, $data["cMoneTiPag"]);
        $this->gPaConEIni->add($cMoneTiPag);

        $dDMoneTiPag = new TagLeaf(DE::D_D_MONE_TI_PAG, $data["dDMoneTiPag"]);
        $this->gPaConEIni->add($dDMoneTiPag);

        if (
            $data["dTiCamTiPag"] &&
            $data["cMoneTiPag"] != MonedaOperacion::PYG->value
        ) {
            $dTiCamTiPag = new TagLeaf(DE::D_TI_CAM_TI_PAG, $data["dTiCamTiPag"]);
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
        $gPagTarCD = new TagComposite(DE::G_PAG_TAR_CD);

        $iDenTarj = new TagLeaf(DE::I_DEN_TARJ, $data["iDenTarj"]);
        $gPagTarCD->add($iDenTarj);

        $dDesDenTarj = new TagLeaf(DE::D_DES_DEN_TARJ, $data["dDesDenTarj"]);
        $gPagTarCD->add($dDesDenTarj);

        if ($data["dRSProTar"]) {
            $dRSProTar = new TagLeaf(DE::D_RS_PRO_TAR, $data["dRSProTar"]);
            $gPagTarCD->add($dRSProTar);
        }

        if (
            isset($data["dRUCProTar"]) &&
            isset($data["dDVProTar"])
        ) {
            $dRUCProTar = new TagLeaf(DE::D_RUC_PRO_TAR, $data["dRUCProTar"]);
            $gPagTarCD->add($dRUCProTar);

            $dDVProTar = new TagLeaf(DE::D_DV_PRO_TAR, $data["dDVProTar"]);
            $gPagTarCD->add($dDVProTar);
        }

        $iForProPa = new TagLeaf(DE::I_FOR_PRO_PA, $data["iForProPa"]);
        $gPagTarCD->add($iForProPa);

        if ($data["dCodAuOpe"]) {
            $dCodAuOpe = new TagLeaf(DE::D_COD_AU_OPE, $data["dCodAuOpe"]);
            $gPagTarCD->add($dCodAuOpe);
        }

        if ($data["dNomTit"]) {
            $dNomTit = new TagLeaf(DE::D_NOM_TIT, $data["dNomTit"]);
            $gPagTarCD->add($dNomTit);
        }

        if ($data["dNumTarj"]) {
            $dNumTarj = new TagLeaf(DE::D_NUM_TARJ, $data["dNumTarj"]);
            $gPagTarCD->add($dNumTarj);
        }

        $this->gPaConEIni->add($gPagTarCD);
    }

    public function setGroupE712($data)
    {
        $gPagCheq = new TagComposite(DE::G_PAG_CHEQ);

        $dNumCheq = new TagLeaf(DE::D_NUM_CHEQ, $data["dNumCheq"]);
        $gPagCheq->add($dNumCheq);

        $dBcoEmi = new TagLeaf(DE::D_BCO_EMI, $data["dBcoEmi"]);
        $gPagCheq->add($dBcoEmi);

        $this->gPaConEIni->add($gPagCheq);
    }

    public function setGroupE72($data)
    {
        $this->gPagCred = new TagComposite(DE::G_PAG_CRED);

        $iCondCred = new TagLeaf(DE::I_COND_CRED, $data["iCondCred"]);
        $this->gPagCred->add($iCondCred);

        $dDCondCred = new TagLeaf(DE::D_D_COND_CRED, $data["dDCondCred"]);
        $this->gPagCred->add($dDCondCred);

        if ($iCondCred->getValue() == CondicionCredito::PLAZO->value) {
            $dPlazoCre = new TagLeaf(DE::D_PLAZO_CRE, $data["dPlazoCre"]);
            $this->gPagCred->add($dPlazoCre);
        }

        if ($iCondCred->getValue() == CondicionCredito::CUOTA->value) {
            $dCuotas = new TagLeaf(DE::D_CUOTAS, $data["dCuotas"]);
            $this->gPagCred->add($dCuotas);
        }

        if ($data["dMonEnt"]) {
            $dMonEnt = new TagLeaf(DE::D_MON_ENT, $data["dMonEnt"]);
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
        $gCuotas = new TagComposite(DE::G_CUOTAS);

        $cMoneCuo = new TagLeaf(DE::C_MONE_CUO, $data["cMoneCuo"]);
        $gCuotas->add($cMoneCuo);

        $dDMoneCuo = new TagLeaf(DE::D_D_MONE_CUO, $data["dDMoneCuo"]);
        $gCuotas->add($dDMoneCuo);

        $dMonCuota = new TagLeaf(DE::D_MON_CUOTA, $data["dMonCuota"]);
        $gCuotas->add($dMonCuota);

        if ($data["dVencCuo"]) {
            $dVencCuo = new TagLeaf(DE::D_VENC_CUO, $data["dVencCuo"]);
            $gCuotas->add($dVencCuo);
        }

        $this->gPagCred->add($gCuotas);
    }

    public function setGroupE8($data)
    {
        $this->gCamItem = new TagComposite(DE::G_CAM_ITEM);

        $dCodInt = new TagLeaf(DE::D_COD_INT, $data["dCodInt"]);
        $this->gCamItem->add($dCodInt);

        if ($data["dParAranc"]) {
            $dParAranc = new TagLeaf(DE::D_PAR_ARANC, $data["dParAranc"]);
            $this->gCamItem->add($dParAranc);
        }

        if ($data["dNCM"]) {
            $dNCM = new TagLeaf(DE::D_NCM, $data["dNCM"]);
            $this->gCamItem->add($dNCM);
        }

        $iTiOpe = $this->gDatRec->getTag(DE::I_TI_OPE->value);
        if (
            $iTiOpe->getValue() == TipoOperacion::B2G->value &&
            !empty($data["dDncpG"]) &&
            !empty($data["dDncpE"])
        ) {
            $dDncpG = new TagLeaf(DE::D_DNCP_G, $data["dDncpG"]);
            $this->gCamItem->add($dDncpG);

            $dDncpE = new TagLeaf(DE::D_DNCP_E, $data["dDncpE"]);
            $this->gCamItem->add($dDncpE);
        }

        if ($data["dGtin"]) {
            $dGtin = new TagLeaf(DE::D_GTIN, $data["dGtin"]);
            $this->gCamItem->add($dGtin);
        }

        if ($data["dGtinPq"]) {
            $dGtinPq = new TagLeaf(DE::D_GTIN_PQ, $data["dGtinPq"]);
            $this->gCamItem->add($dGtinPq);
        }

        $dDesProSer = new TagLeaf(DE::D_DES_PRO_SER, $data["dDesProSer"]);
        $this->gCamItem->add($dDesProSer);

        $cUniMed = new TagLeaf(DE::C_UNI_MED, $data["cUniMed"]);
        $this->gCamItem->add($cUniMed);

        $dDesUniMed = new TagLeaf(DE::D_DES_UNI_MED, $data["dDesUniMed"]);
        $this->gCamItem->add($dDesUniMed);

        $dCantProSer = new TagLeaf(DE::D_CANT_PRO_SER, $data["dCantProSer"]);
        $this->gCamItem->add($dCantProSer);

        if (
            $data["cPaisOrig"] &&
            $data["dDesPaisOrig"]
        ) {
            $cPaisOrig = new TagLeaf(DE::C_PAIS_ORIG, $data["cPaisOrig"]);
            $this->gCamItem->add($cPaisOrig);

            $dDesPaisOrig = new TagLeaf(DE::D_DES_PAIS_ORIG, $data["dDesPaisOrig"]);
            $this->gCamItem->add($dDesPaisOrig);
        }

        if ($data["dInfItem"]) {
            $dInfItem = new TagLeaf(DE::D_INF_ITEM, $data["dInfItem"]);
            $this->gCamItem->add($dInfItem);
        }

        $iTipTra = $this->gOpeCom->getTag(DE::I_TIP_TRA->value);
        if (
            $iTipTra->getValue() == TipoTransaccion::ANTICIPO->value &&
            $data["dCDCAnticipo"]
        ) {
            $dCDCAnticipo = new TagLeaf(DE::D_CDC_ANTICIPO, $data["dCDCAnticipo"]);
            $this->gCamItem->add($dCDCAnticipo);
        }

        $this->setGroupE81($data);
        $this->setGroupE82($data);

        $this->gDTipDE->add($this->gCamItem);
    }

    public function setGroupE81($data)
    {
        $this->gValorItem = new TagComposite(DE::G_VALOR_ITEM);

        $dPUniProSer = new TagLeaf(DE::D_P_UNI_PRO_SER, $data["dPUniProSer"]);
        $this->gValorItem->add($dPUniProSer);

        $dCondTiCam = $this->gOpeCom->getTag(DE::D_COND_TI_CAM->value);
        if (
            $dCondTiCam != null &&
            $dCondTiCam->getValue() == TipoCambioOperacion::ITEM->value &&
            $data["dTiCamIt"]
        ) {
            $dTiCamIt = new TagLeaf(DE::D_TI_CAM_IT, $data["dTiCamIt"]);
            $this->gValorItem->add($dTiCamIt);
        }

        $dTotBruOpeItem = new TagLeaf(DE::D_TOT_BRU_OPE_ITEM, $data["dTotBruOpeItem"]);
        $this->gValorItem->add($dTotBruOpeItem);

        /**
         * Grupo E.8.1.1
         */
        $this->setGroupE811($data);

        $this->gCamItem->add($this->gValorItem);
    }

    public function setGroupE811($data)
    {
        $gValorRestaItem = new TagComposite(DE::G_VALOR_RESTA_ITEM);

        $dDescItem = new TagLeaf(DE::D_DESC_ITEM, $data['dDescItem'] ?? 0);
        $gValorRestaItem->add($dDescItem);

        if ($dDescItem->getValue() > 0) {
            $dPorcDesIt = new TagLeaf(DE::D_PORC_DES_IT, $data['dPorcDesIt']);
            $gValorRestaItem->add($dPorcDesIt);
        }

        if ($data['dDescGloItem']) {
            $dDescGloItem = new TagLeaf(DE::D_DESC_GLO_ITEM, $data['dDescGloItem']);
            $gValorRestaItem->add($dDescGloItem);
        }

        $dAntPreUniIt = new TagLeaf(DE::D_ANT_PRE_UNI_IT, $data['dAntPreUniIt'] ?? 0);
        $gValorRestaItem->add($dAntPreUniIt);

        $dAntGloPreUniIt = new TagLeaf(DE::D_ANT_GLO_PRE_UNI_IT, $data['dAntGloPreUniIt'] ?? 0);
        $gValorRestaItem->add($dAntGloPreUniIt);

        $dTotOpeItem = new TagLeaf(DE::D_TOT_OPE_ITEM, $data['dTotOpeItem']);
        $gValorRestaItem->add($dTotOpeItem);

        $dTiCamIt = $this->gValorItem->getTag(DE::D_TI_CAM_IT->value);
        if (!empty($dTiCamIt)) {
            $dTotOpeGs = new TagLeaf(DE::D_TOT_OPE_GS, $data['dTotOpeGs']);
            $gValorRestaItem->add($dTotOpeGs);
        }

        $this->gValorItem->add($gValorRestaItem);
    }

    public function setGroupE82($data)
    {
        $gCamIVA = new TagComposite(DE::G_CAM_IVA);

        $iAfecIVA = new TagLeaf(DE::I_AFEC_IVA, $data['iAfecIVA']);
        $gCamIVA->add($iAfecIVA);

        $dDesAfecIVA = new TagLeaf(DE::D_DES_AFEC_IVA, $data['dDesAfecIVA']);
        $gCamIVA->add($dDesAfecIVA);

        $dPropIVA = new TagLeaf(DE::D_PROP_IVA, $data['dPropIVA']);
        $gCamIVA->add($dPropIVA);

        $dTasaIVA = new TagLeaf(DE::D_TASA_IVA, $data['dTasaIVA']);
        $gCamIVA->add($dTasaIVA);

        $dBasGravIVA = new TagLeaf(DE::D_BAS_GRAV_IVA, $data['dBasGravIVA']);
        $gCamIVA->add($dBasGravIVA);

        $dLiqIVAItem = new TagLeaf(DE::D_LIQ_IVA_ITEM, $data['dLiqIVAItem']);
        $gCamIVA->add($dLiqIVAItem);

        $this->gCamItem->add($gCamIVA);
    }

    public function setGroupF($data)
    {
        $this->gTotSub = new TagComposite(DE::G_TOT_SUB);

        $dSubExe = new TagLeaf(DE::D_SUB_EXE, $data['dSubExe'] ?? 0);
        $this->gTotSub->add($dSubExe);

        $dSubExo = new TagLeaf(DE::D_SUB_EXO, $data['dSubExo'] ?? 0);
        $this->gTotSub->add($dSubExo);

        $dSub5 = new TagLeaf(DE::D_SUB5, $data['dSub5'] ?? 0);
        $this->gTotSub->add($dSub5);

        $dSub10 = new TagLeaf(DE::D_SUB10, $data['dSub10'] ?? 0);
        $this->gTotSub->add($dSub10);

        $dTotOpe = new TagLeaf(DE::D_TOT_OPE, $data['dTotOpe'] ?? 0);
        $this->gTotSub->add($dTotOpe);

        $dTotDesc = new TagLeaf(DE::D_TOT_DESC, $data['dTotDesc'] ?? 0);
        $this->gTotSub->add($dTotDesc);

        $dTotDescGlotem = new TagLeaf(DE::D_TOT_DESC_GLO_TEM, $data['dTotDescGlotem'] ?? 0);
        $this->gTotSub->add($dTotDescGlotem);

        $dTotAntItem = new TagLeaf(DE::D_TOT_ANT_ITEM, $data['dTotAntItem'] ?? 0);
        $this->gTotSub->add($dTotAntItem);

        $dTotAnt = new TagLeaf(DE::D_TOT_ANT, $data['dTotAnt'] ?? 0);
        $this->gTotSub->add($dTotAnt);

        $dPorcDescTotal = new TagLeaf(DE::D_PORC_DESC_TOTAL, $data['dPorcDescTotal'] ?? 0);
        $this->gTotSub->add($dPorcDescTotal);

        $dDescTotal = new TagLeaf(DE::D_DESC_TOTAL, $data['dDescTotal'] ?? 0);
        $this->gTotSub->add($dDescTotal);

        $dAnticipo = new TagLeaf(DE::D_ANTICIPO, $data['dAnticipo'] ?? 0);
        $this->gTotSub->add($dAnticipo);

        $dRedon = new TagLeaf(DE::D_REDON, $data['dRedon'] ?? 0);
        $this->gTotSub->add($dRedon);

        $dComi = new TagLeaf(DE::D_COMI, $data['dComi'] ?? 0);
        $this->gTotSub->add($dComi);

        $dTotGralOpe = new TagLeaf(DE::D_TOT_GRAL_OPE, $data['dTotGralOpe'] ?? 0);
        $this->gTotSub->add($dTotGralOpe);

        $dIVA5 = new TagLeaf(DE::D_IVA5, $data['dIVA5'] ?? 0);
        $this->gTotSub->add($dIVA5);

        $dIVA10 = new TagLeaf(DE::D_IVA10, $data['dIVA10'] ?? 0);
        $this->gTotSub->add($dIVA10);

        $dLiqTotIVA5 = new TagLeaf(DE::D_LIQ_TOT_IVA5, $data['dLiqTotIVA5'] ?? 0);
        $this->gTotSub->add($dLiqTotIVA5);

        $dLiqTotIVA10 = new TagLeaf(DE::D_LIQ_TOT_IVA10, $data['dLiqTotIVA10'] ?? 0);
        $this->gTotSub->add($dLiqTotIVA10);

        $dIVAComi = new TagLeaf(DE::D_IVA_COMI, $data['dIVAComi'] ?? 0);
        $this->gTotSub->add($dIVAComi);

        $dTotIVA = new TagLeaf(DE::D_TOT_IVA, $data['dTotIVA'] ?? 0);
        $this->gTotSub->add($dTotIVA);

        $dBaseGrav5 = new TagLeaf(DE::D_BASE_GRAV5, $data['dBaseGrav5'] ?? 0);
        $this->gTotSub->add($dBaseGrav5);

        $dBaseGrav10 = new TagLeaf(DE::D_BASE_GRAV10, $data['dBaseGrav10'] ?? 0);
        $this->gTotSub->add($dBaseGrav10);

        $dTBasGraIVA = new TagLeaf(DE::D_T_BAS_GRAL_IVA, $data['dTBasGraIVA'] ?? 0);
        $this->gTotSub->add($dTBasGraIVA);

        $dTotalGs = new TagLeaf(DE::D_TOTAL_GS, $data['dTotalGs'] ?? 0);
        $this->gTotSub->add($dTotalGs);

        $this->de->add($this->gTotSub);
    }

    public function setGroupH($data)
    {
        if (in_array($this->iTiDE->getValue(), [
            TipoDocumentoElectronico::FEE->value,
            TipoDocumentoElectronico::FEI->value,
            TipoDocumentoElectronico::CRE->value,
        ])) {
            return;
        }

        if (empty($data['iTipDocAso'])) {
            return;
        }

        $this->gCamDEAsoc = new TagComposite(DE::G_CAM_DE_ASOC);

        $iTipDocAso = new TagLeaf(DE::I_TIP_DOC_ASO, $data['iTipDocAso']);
        $this->gCamDEAsoc->add($iTipDocAso);

        $dDesTipDocAso = new TagLeaf(DE::D_DES_TIP_DOC_ASO, $data['dDesTipDocAso']);
        $this->gCamDEAsoc->add($dDesTipDocAso);

        if ($iTipDocAso->getValue() === TipoDocumentoAsociado::ELECTRONICO->value) {
            $dCdCDERef = new TagLeaf(DE::D_CDC_DE_REF, $data['dCdCDERef']);
            $this->gCamDEAsoc->add($dCdCDERef);
        }

        if ($iTipDocAso->getValue() === TipoDocumentoAsociado::IMPRESO->value) {
            $dNTimDI = new TagLeaf(DE::D_N_TIM_DI, $data['dNTimDI']);
            $this->gCamDEAsoc->add($dNTimDI);

            $dEstDocAso = new TagLeaf(DE::D_EST_DOC_ASO, $data['dEstDocAso']);
            $this->gCamDEAsoc->add($dEstDocAso);

            $dPExpDocAso = new TagLeaf(DE::D_P_EXP_DOC_ASO, $data['dPExpDocAso']);
            $this->gCamDEAsoc->add($dPExpDocAso);

            $dNumDocAso = new TagLeaf(DE::D_NUM_DOC_ASO, $data['dNumDocAso']);
            $this->gCamDEAsoc->add($dNumDocAso);

            $iTipoDocAso = new TagLeaf(DE::I_TIP_DOC_ASO, $data['iTipoDocAso']);
            $this->gCamDEAsoc->add($iTipoDocAso);

            $dDTipoDocAso = new TagLeaf(DE::D_D_TIPO_DOC_ASO, $data['dDTipoDocAso']);
            $this->gCamDEAsoc->add($dDTipoDocAso);

            $dFecEmiDI = new TagLeaf(DE::D_FEC_EMI_DI, $data['dFecEmiDI']);
            $this->gCamDEAsoc->add($dFecEmiDI);
        }

        if ($iTipDocAso->getValue() === TipoDocumentoAsociado::CONSTANCIA_ELECTRONICA->value) {
            $iTipCons = new TagLeaf(DE::I_TIP_CONS, $data['iTipCons']);
            $this->gCamDEAsoc->add($iTipCons);

            $dDesTipCons = new TagLeaf(DE::D_DES_TIP_CONS, $data['dDesTipCons']);
            $this->gCamDEAsoc->add($dDesTipCons);

            if ($iTipCons->getValue() === TipoConstancia::CONSTANCIA_MICROPRODUCTORES->value) {
                $dNumCons = new TagLeaf(DE::D_NUM_CONS, $data['dNumCons']);
                $this->gCamDEAsoc->add($dNumCons);

                $dNumControl = new TagLeaf(DE::D_NUM_CONTROL, $data['dNumControl']);
                $this->gCamDEAsoc->add($dNumControl);
            }
        }
        $this->de->add($this->gCamDEAsoc);
    }

    public function getResult()
    {
        $element = $this->de->render($this->doc);
        $this->doc->appendChild($element);
        return $this->doc->saveXML();
    }
}
