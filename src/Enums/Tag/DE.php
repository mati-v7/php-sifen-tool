<?php

namespace Nyxcode\PhpSifenTool\Enums\Tag;

/**
 * Enum DE
 *
 * Represents a set of string-based enumeration values for the DE tag.
 * Used to define specific constants related to the DE tag within the application.
 *
 */
enum DE: string
{
    // Campos que identifican el formato electrónico XML (AA001-AA009)

/** Documento Electrónco elemento raíz - AA001.*/
    case R_DE = 'rDE';
/** Versión del formato - AA002.*/
    case D_VER_FOR = 'dVerFor';

    // Grupo A. Campos firmados del Documento Electrónico (A001-A099)

/** Campos firmados del DE - A001.*/
    case DE = 'DE';
/** Dígito verificador del identificador del DE - A003*/
    case D_DV_ID = 'dDVId';
/** Fecha de la firma - A004.*/
    case D_FEC_FIRMA = 'dFecFirma';
/** Sistema de facturación - A005.*/
    case D_SIS_FACT = 'dSisFact';

    // Grupo B. Campos inherentes a la operación de Documentos Electrónicos (B001-B099)

/** Campos inherentes a la operación de DE - B001.*/
    case G_OPE_DE = 'gOpeDE';
/** Tipo de emisión - B002.*/
    case I_TIP_EMI = 'iTipEmi';
/** Descripción del tipo de emisión - B003.*/
    case D_DES_TIP_EMI = 'dDesTipEmi';
/** Código de seguridad - B004.*/
    case D_COD_SEG = 'dCodSeg';
/** Información de interés del emisor respecto al DE - B005.*/
    case D_INFO_EMI = 'dInfoEmi';
/** Información de interés del Fisco respecto al DE - B006.*/
    case D_INFO_FISC = 'dInfoFisc';

    // Grupo C. Campos de datos del Timbrado (C001-C099)

/** Datos del timbrado - C001.*/
    case G_TIMB = 'gTimb';
/** Tipo de Documento Electrónico - C002.*/
    case I_TI_DE = 'iTiDE';
/** Descripción del tipo de documento electrónico - C003.*/
    case D_DES_TI_DE = 'dDesTiDE';
/** Número del timbrado - C004.*/
    case D_NUM_TIM = 'dNumTim';
/** Establecimiento - C005.*/
    case D_EST = 'dEst';
/** Punto de expedición - C006.*/
    case D_PUN_EXP = 'dPunExp';
/** Número del documento - C007.*/
    case D_NUM_DOC = 'dNumDoc';
/** Serie del número de timbrado - C010.*/
    case D_SERIE_NUM = 'dSerieNum';
/** Fecha inicio de vigencia del timbrado - C008.*/
    case D_FE_INI_T = 'dFeIniT';
/** @deprecated Fecha fin de vigencia del timbrado - C009.*/
    case D_FE_FIN_T = 'dFeFinT';

    // Grupo D. Campos Generales del Documento Electrónico DE (D001-D299)

/** Campos generales del DE - D001.*/
    case G_DAT_GRAL_OPE = 'gDatGralOpe';
/** Fecha y hora de emisión del DE - D002.*/
    case D_FE_EMI_DE = 'dFeEmiDE';

    // Grupo D.1. Campos inherentes a la operación comercial (D010-D099)

/** Campos inherentes a la operación comercial - D010.*/
    case G_OPE_COM = 'gOpeCom';
/** Tipo de transacción - D011.*/
    case I_TIP_TRA = 'iTipTra';
/** Descripción del Tipo de transacción - D012.*/
    case D_DES_TIP_TRA = 'dDesTipTra';
/** Tipo de Impuesto afectado - D013.*/
    case I_T_IMP = 'iTImp';
/** Descripción del Tipo de Impuesto afectado - D014.*/
    case D_DES_T_IMP = 'dDesTImp';
/** Moneda de la Operación - D015.*/
    case C_MONE_OPE = 'cMoneOpe';
/** Descripción de Moneda de la Operación - D016.*/
    case D_DES_MONE_OPE = 'dDesMoneOpe';
/** Condición del tipo de cambio - D017.*/
    case D_COND_TI_CAM = 'dCondTiCam';
/** Tipo de cambio de la operación - D018.*/
    case D_TI_CAM = 'dTiCam';
/** Condición del Anticipo - D019.*/
    case I_COND_ANT = 'iCondAnt';
/** Descripción de la condición del Anticipo - D020.*/
    case D_DES_COND_ANT = 'dDesCondAnt';

    // Grupo D.2. Campos que identifican al emisor del Documento Electrónico DE (D100-D129)

/** Grupo de campos que identifican al emisor - D100.*/
    case G_EMIS = 'gEmis';
/** RUC del contribuyente - D101.*/
    case D_RUC_EM = 'dRucEm';
/** Dígito verificador del RUC del contribuyente emisor - D102.*/
    case D_DV_EMI = 'dDVEmi';
/** Tipo de contribuyente - D103.*/
    case I_TIP_CONT = 'iTipCont';
/** Tipo de régimen - D104.*/
    case C_TIP_REG = 'cTipReg';
/** Nombre o razón social del emisor del DE - D105.*/
    case D_NOM_EMI = 'dNomEmi';
/** Nombre de fantasía - D106.*/
    case D_NOM_FAN_EMI = 'dNomFanEmi';
/** Dirección del local donde se emite el DE - D107.*/
    case D_DIR_EMI = 'dDirEmi';
/** Número de casa - D108.*/
    case D_NUM_CAS = 'dNumCas';
/** Complemento de dirección 1 - D109.*/
    case D_COMP_DIR1 = 'dCompDir1';
/** Complemento de dirección 2 - D110.*/
    case D_COMP_DIR2 = 'dCompDir2';
/** Código del departamento de emisión - D111.*/
    case C_DEP_EMI = 'cDepEmi';
/** Descripción del departamento de emisión - D112.*/
    case D_DES_DEP_EMI = 'dDesDepEmi';
/** Código del distrito de emisión - D113.*/
    case C_DIS_EMI = 'cDisEmi';
/** Descripción del distrito de emisión - D114.*/
    case D_DES_DIS_EMI = 'dDesDisEmi';
/** Código de la ciudad de emisión - D115.*/
    case C_CIU_EMI = 'cCiuEmi';
/** Descripción de la ciudad de emisión - D116.*/
    case D_DES_CIU_EMI = 'dDesCiuEmi';
/** Teléfono local de emisión de DE - D117.*/
    case D_TEL_EMI = 'dTelEmi';
/** Correo electrónico del emisor - D118.*/
    case D_EMAIL_E = 'dEmailE';
/** Denominación comercial de la sucursal - D119.*/
    case D_DEN_SUC = 'dDenSuc';

    // Grupo D.2.1. Campos que describen la actividad económica del emisor (D130-D139)

/** Grupo de campos que describen la actividad económica del emisor - D130.*/
    case G_ACT_ECO = 'gActEco';
/** Código de la actividad económica del emisor - D131.*/
    case C_ACT_ECO = 'cActEco';
/** Descripción de la actividad económica del emisor - D132.*/
    case D_DES_ACT_ECO = 'dDesActEco';

    // Grupo D.2.2. Campos que identifican al responsable de la generación del DE (D140-D160)

/** Grupo de campos que identifican al responsable de la generación del DE - D140.*/
    case G_RESP_DE = 'gRespDE';
/** Tipo de documento de identidad del responsable de la generación del DE - D141.*/
    case I_TIP_ID_RESP_DE = 'iTipIDRespDE';
/** Descripción del tipo de documento de identidad del responsable de la generación del DE - D142.*/
    case D_D_TIP_ID_RESP_DE = 'dDTipIDRespDE';
/** Número de documento de identidad del responsable de la generación del DE - D143.*/
    case D_NUM_ID_RESP_DE = 'dNumIDRespDE';
/** Nombre o razón social del responsable de la generación del DE - D144.*/
    case D_NOM_RESP_DE = 'dNomRespDE';
/** Cargo del responsable de la generación del DE - D145.*/
    case D_CAR_RESP_DE = 'dCarRespDE';

    // Grupo D.3. Campos que identifican al receptor del Documento Electrónico DE (D200-D299)

/** Grupo de campos que identifican al receptor - D200.*/
    case G_DAT_REC = 'gDatRec';
/** Naturaleza del receptor - D201.*/
    case I_NAT_REC = 'iNatRec';
/** Tipo de operación - D202.*/
    case I_TI_OPE = 'iTiOpe';
/** Código de país del receptor - D203.*/
    case C_PAIS_REC = 'cPaisRec';
/** Descripción del país del receptor - D204.*/
    case D_DES_PAIS_RE = 'dDesPaisRe';
/** Tipo de contrinbuyente receptor - D205.*/
    case I_TI_CONT_REC = 'iTiContRec';
/** RUC del receptor - D206.*/
    case D_RUC_REC = 'dRucRec';
/** Dígito verificador del RUC del receptor - D207.*/
    case D_DV_REC = 'dDVRec';
/** Tipo de documento de identidad del receptor - D208.*/
    case I_TIP_ID_REC = 'iTipIDRec';
/** Descripción del Tipo de documento de identidad del receptor - D209.*/
    case D_D_TIP_ID_REC = 'dDTipIDRec';
/** Número de documento de identidad - D210.*/
    case D_NUM_ID_REC = 'dNumIDRec';
/** Nombre o razón social del receptor del DE - D211.*/
    case D_NOM_REC = 'dNomRec';
/** Nombre de fantisía - D212.*/
    case D_NOM_FAN_REC = 'dNomFanRec';
/** Dirección del receptor - D213.*/
    case D_DIR_REC = 'dDirRec';
/** Número de casa del receptor - D218.*/
    case D_NUM_CAS_REC = 'dNumCasRec';
/** Código del departamento del receptor - D219.*/
    case C_DEP_REC = 'cDepRec';
/** Descipción del departamento del receptor - D220.*/
    case D_DES_DEP_REC = 'dDesDepRec';
/** Código del distrito del receptor - D221.*/
    case C_DIS_REC = 'cDisRec';
/** Descripción del distrito del receptor - D222.*/
    case D_DES_DIS_REC = 'dDesDisRec';
/** Código de la ciudad del receptor - D223.*/
    case C_CIU_REC = 'cCiuRec';
/** Descripción de la ciudad del receptor - D224.*/
    case D_DES_CIU_REC = 'dDesCiuRec';
/** Número de teléfono del receptor - D214.*/
    case D_TEL_REC = 'dTelRec';
/** Número de celular del receptor - D215.*/
    case D_CEL_REC = 'dCelRec';
/** Correo electrónico del receptor - D216.*/
    case D_EMAIL_REC = 'dEmailRec';
/** Código del cliente - D217.*/
    case D_COD_CLIENTE = 'dCodCliente';

    // Grupo E. Campos específicos por tipo de Documento Electrónico (E001-E009)

/** Campos específicos por tipo de Documento Electrónico - E001.*/
    case G_D_TIP_DE = 'gDtipDE';

    // Grupo E1. Campos que componen la Factura Electrónica FE (E002-E099)

/** Campos que componen la FE - E010.*/
    case G_CAM_FE = 'gCamFE';
/** Indicador de presencia - E011.*/
    case I_IND_PRES = 'iIndPres';
/** Descipción del indicador de presencia - E012.*/
    case D_DES_IND_PRES = 'dDesIndPres';
/** Fecha futura del traslado de mercadería - E013.*/
    case D_FEC_EM_NR = 'dFecEmNR';

    // Grupo E1.1. Campos de informaciones de Compras Públicas (E020-E029)

/** Campos que describen las informaciones de compras públicas - E020.*/
    case G_COMP_PUB = 'gCompPub';
/** Modalidad - Código emitido por la DNCP - E021.*/
    case D_MOD_CONT = 'dModCont';
/** Entidad - Código emitido por la DNCP - E022.*/
    case D_ENT_CONT = 'dEntCont';
/** Año - Código emitido por la DNCP - E023.*/
    case D_ANO_CONT = 'dAnoCont';
/** Secuencia - Código emitido por la DNCP - E024.*/
    case D_SEC_CONT = 'dSecCont';
/** Fecha de emisión del código de contratación por la DNCP - E025.*/
    case D_FE_COD_CONT = 'dFeCodCont';

    // Grupo E4. Campos que componen la Autofactura Electrónica AFE (E300-E399)

/** Campos que componen la Autofactura Electrónica - E300.*/
    case G_CAM_AE = 'gCamAE';
/** Naturaleza del vendedor - E301.*/
    case I_NAT_VEN = 'iNatVen';
/** Descripción de la naturaleza del vendedor - E302.*/
    case D_DES_NAT_VEN = 'dDesNatVen';
/** Tipo de documento de indentidad del vendedor - E304.*/
    case I_TIP_ID_VEN = 'iTipIDVen';
/** Descripción del tipo de documento de identidad del vendedor - E305.*/
    case D_D_TIP_ID_VEN = 'dDTipIDVen';
/** Número de documento de identidad del vendedor - E306.*/
    case D_NUM_ID_VEN = 'dNumIDVen';
/** Nombre y apellido del vendedor - E307.*/
    case D_NOM_VEN = 'dNomVen';
/** Dirección del vendedor - E308.*/
    case D_DIR_VEN = 'dDirVen';
/** Número de casa del vendedor - E309.*/
    case D_NUM_CAS_VEN = 'dNumCasVen';
/** Código del departamento del vendedor - E310.*/
    case C_DEP_VEN = 'cDepVen';
/** Descripción del departamento del vendedor - E311.*/
    case D_DES_DEP_VEN = 'dDesDepVen';
/** Código del distrito del vendedor - E312.*/
    case C_DIS_VEN = 'cDisVen';
/** Descripción del distrito del vendedor - E313.*/
    case D_DES_DIS_VEN = 'dDesDisVen';
/** Código de la ciudad del vendedor - E314.*/
    case C_CIU_VEN = 'cCiuVen';
/** Descripción de la ciudad del vendedor - E315.*/
    case D_DES_CIU_VEN = 'dDesCiuVen';
/** Lugar de la transacción - E316.*/
    case D_DIR_PROV = 'dDirProv';
/** Código del departamento donde se realiza la transacción - E317.*/
    case C_DEP_PROV = 'cDepProv';
/** Descripción del departamento donde se realiza la transacción - E318.*/
    case D_DES_DEP_PROV = 'dDesDepProv';
/** Código del distrito donde se realiza la transacción - E319.*/
    case C_DIS_PROV = 'cDisProv';
/** Descripción del distrito donde se realiza la transacción - E320.*/
    case D_DES_DIS_PROV = 'dDesDisProv';
/** Código de la ciudad donde se realiza la transacción - E321.*/
    case C_CIU_PROV = 'cCiuProv';
/** Descipción de la ciudad donde se realiza la transacción - E322.*/
    case D_DES_CIU_PROV = 'dDesCiuProv';

    // Grupo E5. Campos que componen la Nota de Crédito/Débito Electrónica NCE-NDE (E400-E499)

/** Campos de la Nota de Crédito/Débito Electrónica - E400.*/
    case G_CAM_NCDE = 'gCamNCDE';
/** Motivo de emisión - E401.*/
    case I_MOT_EMI = 'iMotEmi';
/** Descripción del motivo de emisión - E402.*/
    case D_DES_MOT_EMI = 'dDesMotEmi';

    // Grupo E6. Campos que componen la Nota de Remisión Electrónica (E500-E599)

/** Campos que componen la Nota de Remisión Electrónica - E500.*/
    case G_CAM_NRE = 'gCamNRE';
/** Motivo de Emsión - E501.*/
    case I_MOT_EMI_NR = 'iMotEmiNR';
/** Descripción del motivo de emisión - E502.*/
    case D_DES_MOT_EMI_NR = 'dDesMotEmiNR';
/** Responsable de la emisión de la Nota de Remisión Electrónica - E503.*/
    case I_RESP_EMI_NR = 'iRespEmiNR';
/** Descripción del responsable de la emisión de la Nota de Remisión Electrónica - E504.*/
    case D_DES_RESP_EMI_NR = 'dDesRespEmiNR';
/** Kilómetros estimados de recorrido - E505.*/
    case D_KM_R = 'dKmR';
/** Fecha futura de emisión de la factura - E506.*/
    case D_FEC_EM = 'dFecEm';

    // Grupo E7. Campos que describen la condición de la operación (E600-E699)

/** Campos que describen la condición de la operación - E600.*/
    case G_CAM_COND = 'gCamCond';
/** Condición de la operación - E601.*/
    case I_COND_OPE = 'iCondOpe';
/** Descripción de la condición de operación - E602.*/
    case D_D_COND_OPE = 'dDCondOpe';

    // Grupo E7.1. Campos que describen la forma de pago de la operación al contado o
    // del monto de la entrega inicial (E605-E619)

/** Campos que describen la forma de pago al contado o del monto de la entrega inicial - E605.*/
    case G_PA_CON_E_INI = 'gPaConEIni';
/** Tipo de Pago - E606.*/
    case I_TI_PAGO = 'iTiPago';
/** Descripción del tipo de pago - E607.*/
    case D_DES_TI_PAG = 'dDesTiPag';
/** Monto por tipo de pago - E608.*/
    case D_MON_TI_PAG = 'dMonTiPag';
/** Moneda por tipo de pago - E609.*/
    case C_MONE_TI_PAG = 'cMoneTiPag';
/** Descripción de la moneda por tipo de pago - E610.*/
    case D_D_MONE_TI_PAG = 'dDMoneTiPag';
/** Tipo de cambio por tipo de pago - E611.*/
    case D_TI_CAM_TI_PAG = 'dTiCamTiPag';

    // Grupo E7.1.1. Campos que describen el pago o entrega inicial de la operación con tarjeta de crédito/débito

/** Campos que describen el pago o entrega inicial de la operación con tarjeta de crédito/débito - E620.*/
    case G_PAG_TAR_CD = 'gPagTarCD';
/** Denominación de la tarjeta - E621.*/
    case I_DEN_TARJ = 'iDenTarj';
/** Descripción de la denominación de la tarjeta - E622.*/
    case D_DES_DEN_TARJ = 'dDesDenTarj';
/** Razón social de la procesadora de tarjeta - E623.*/
    case D_RS_PRO_TAR = 'dRSProTar';
/** RUC de la procesadora de tarjeta - E624.*/
    case D_RUC_PRO_TAR = 'dRUCProTar';
/** Dígito verificador del RUC de la procesadora de tarjeta - E625.*/
    case D_DV_PRO_TAR = 'dDVProTar';
/** Forma de procesamiento de pago - E626.*/
    case I_FOR_PRO_PA = 'iForProPa';
/** Código de autorización de la operación - E627.*/
    case D_COD_AU_OPE = 'dCodAuOpe';
/** Nombre del titular de la tarjeta - E628.*/
    case D_NOM_TIT = 'dNomTit';
/** Número de la tarjeta - E629.*/
    case D_NUM_TARJ = 'dNumTarj';

    // Grupo E7.1.2. Campos que describen el pago o entrega inicial de la operación con cheque (E630-E639)

/** Campos que describen el pago o entrega inicial de la operación con cheque - E630.*/
    case G_PAG_CHEQ = 'gPagCheq';
/** Número de cheque - E631.*/
    case D_NUM_CHEQ = 'dNumCheq';
/** Banco emisor - E632.*/
    case D_BCO_EMI = 'dBcoEmi';

    // Grupo E7.2. Campos que describen la operación a crédito (E640-E649)

/** Campos que describen la operación a crédito - E640.*/
    case G_PAG_CRED = 'gPagCred';
/** Condición de la operación a crédito - E641.*/
    case I_COND_CRED = 'iCondCred';
/** Descripción de la condición de la operación a crédito - E642.*/
    case D_D_COND_CRED = 'dDCondCred';
/** Plazo del crédito - E643.*/
    case D_PLAZO_CRE = 'dPlazoCre';
/** Cantidad de cuotas - E644.*/
    case D_CUOTAS = 'dCuotas';
/** Monto de la entrega inicial - E645.*/
    case D_MON_ENT = 'dMonEnt';

    // Grupo E7.2.2. Campos que describen las cuotas (E650-E659)

/** Campos que describen las cuotas - E650.*/
    case G_CUOTAS = 'gCuotas';
/** Moneda de las cuotas - E653.*/
    case C_MONE_CUO = 'cMoneCuo';
/** Descripción de la moneda de las cuotas - E654.*/
    case D_D_MONE_CUO = 'dDMoneCuo';
/** Monto de cada cuota - E651.*/
    case D_MON_CUOTA = 'dMonCuota';
/** Fecha de vencimiento de cada cuota - E652.*/
    case D_VENC_CUO = 'dVencCuo';

    // Grupo E8. Campos que describen los ítems de la operación (E700-E899)

/** Campos que describen los ítems de la operación - E700.*/
    case G_CAM_ITEM = 'gCamItem';
/** Código interno - E701.*/
    case D_COD_INT = 'dCodInt';
/** Partida arancelaría - E702.*/
    case D_PAR_ARANC = 'dParAranc';
/** Nomenclatura común del Mercosur (NCM) - E703.*/
    case D_NCM = 'dNCM';
/** Código DNCP - Nivel General - E704.*/
    case D_DNCP_G = 'dDncpG';
/** Código DNCP - Nivel Especifico - E705.*/
    case D_DNCP_E = 'dDncpE';
/** Código GTIN por producto - E706.*/
    case D_GTIN = 'dGtin';
/** Código GTIN por paquete - E707.*/
    case D_GTIN_PQ = 'dGtinPq';
/** Descripción del producto y/o servicio - E708.*/
    case D_DES_PRO_SER = 'dDesProSer';
/** Unidad de medida - E709.*/
    case C_UNI_MED = 'cUniMed';
/** Descripción de la Unidad de medida - E710.*/
    case D_DES_UNI_MED = 'dDesUniMed';
/** Cantidad del producto y/o servicio - E711.*/
    case D_CANT_PRO_SER = 'dCantProSer';
/** Código del país de origen del producto - E712.*/
    case C_PAIS_ORIG = 'cPaisOrig';
/** Descripción del país de origen del producto - E713.*/
    case D_DES_PAIS_ORIG = 'dDesPaisOrig';
/** Información de interés del emisor con respecto al ítem - E714.*/
    case D_INF_ITEM = 'dInfItem';
/** Código de datos de relevancia de las mercaderías - E715.*/
    case C_REL_MERC = 'cRelMerc';
/** Descripción del código de datos de relevancia de las mercaderías - E716.*/
    case D_DES_REL_MERC = 'dDesRelMerc';
/** Cantidad de quiebra o merma - E717.*/
    case D_CAN_QUI_MER = 'dCanQuiMer';
/** Porcentaje de quiebra o merma - E718.*/
    case D_POR_QUI_MER = 'dPorQuiMer';
/** CDC del anticipo - E719.*/
    case D_CDC_ANTICIPO = 'dCDCAnticipo';

    // Grupo E8.1. Campos que describen el precio, tipo de cambio y valor total de la operación por ítem (E720-E729)

/** Campos que describen los precios, descuentos y valor total por ítem - E720.*/
    case G_VALOR_ITEM = 'gValorItem';
/** Precio unitario del producto y/o servicio (incluido impuestos) - E721.*/
    case D_P_UNI_PRO_SER = 'dPUniProSer';
/** Tipo de cambio por ítem - E725.*/
    case D_TI_CAM_IT = 'dTiCamIt';
/** Total bruto de la operación por ítem - E727.*/
    case D_TOT_BRU_OPE_ITEM = 'dTotBruOpeItem';

    // Grupo E8.1.1. Campos que describen los descuentos, anticipos y valor total por ítem (EA001-EA050)

/** Campos que describen los descuentos, anticipos valor total por ítem - EA001.*/
    case G_VALOR_RESTA_ITEM = 'gValorRestaItem';
/** Descuento particular sobre el precio unitario por ítem (incluidos impuestos) - EA002.*/
    case D_DESC_ITEM = 'dDescItem';
/** Porcentaje de descuento particular por ítem - EA003.*/
    case D_PORC_DES_IT = 'dPorcDesIt';
/** Descuento global sobre el precio unitario por ítem (incluidos impuestos) - EA004.*/
    case D_DESC_GLO_ITEM = 'dDescGloItem';
/** Anticipo particular sobre el precio unitario por ítem (incluidos impuestos) - EA006.*/
    case D_ANT_PRE_UNI_IT = 'dAntPreUniIt';
/** Anticipo global sobre el precio unitario por ítem (incluidos impuestos) - EA007.*/
    case D_ANT_GLO_PRE_UNI_IT = 'dAntGloPreUniIt';
/** Valor total de la operación por ítem - EA008.*/
    case D_TOT_OPE_ITEM = 'dTotOpeItem';
/** Valor total de la operación por ítem en guaraníes - EA009.*/
    case D_TOT_OPE_GS = 'dTotOpeGs';

    // Grupo E8.2. Campos que describen el IVA de la operación por ítem (E730-E739)

/** Campos que describen el IVA de la operación - E730.*/
    case G_CAM_IVA = 'gCamIVA';
/** Forma de afectación tributaria del IVA - E731.*/
    case I_AFEC_IVA = 'iAfecIVA';
/** Descripción de la forma de afectación tributaria del IVA - E732.*/
    case D_DES_AFEC_IVA = 'dDesAfecIVA';
/** Proporción gravada de IVA - E733.*/
    case D_PROP_IVA = 'dPropIVA';
/** Tasa del IVA - E734.*/
    case D_TASA_IVA = 'dTasaIVA';
/** Base gravada del IVA por ítem - E735.*/
    case D_BAS_GRAV_IVA = 'dBasGravIVA';
/** Liquidación del IVA por ítem - E736.*/
    case D_LIQ_IVA_ITEM = 'dLiqIVAItem';

    // Grupo F. Campos que describen los subtotales y totales de la transacción documentada (F001-F099)

/** Campos de subtotales y totales - F001.*/
    case G_TOT_SUB = 'gTotSub';
/** Subtotal de la operación exenta - F002.*/
    case D_SUB_EXE = 'dSubExe';
/** Subtotal de la operación exonerada - F003.*/
    case D_SUB_EXO = 'dSubExo';
/** Subtotal de la operación con IVA incluido a la tasa 5% - F004.*/
    case D_SUB5 = 'dSub5';
/** Subtotal de la operación con IVA incluido a la tasa 10% - F005.*/
    case D_SUB10 = 'dSub10';
/** Total Bruto de la operación - F008.*/
    case D_TOT_OPE = 'dTotOpe';
/** Total descuento particular por ítem - F009.*/
    case D_TOT_DESC = 'dTotDesc';
/** Total descuento global por ítem - F033.*/
    case D_TOT_DESC_GLO_TEM = 'dTotDescGlotem';
/** Total Anticipo por ítem - F034.*/
    case D_TOT_ANT_ITEM = 'dTotAntItem';
/** Total Anticipo global por ítem - F035.*/
    case D_TOT_ANT = 'dTotAnt';
/** Porcentaje de descuento global sobre total de la operación - F010.*/
    case D_PORC_DESC_TOTAL = 'dPorcDescTotal';
/** Total descuentos de la operación - F011.*/
    case D_DESC_TOTAL = 'dDescTotal';
/** Total Anticipos de la operación - F012.*/
    case D_ANTICIPO = 'dAnticipo';
/** Redondeo de la operación - F013.*/
    case D_REDON = 'dRedon';
/** Comisión de la operación - F025.*/
    case D_COMI = 'dComi';
/** Total Neto de la operación - F014.*/
    case D_TOT_GRAL_OPE = 'dTotGralOpe';
/** Liquidación del IVA a la tasa del 5% - F015.*/
    case D_IVA5 = 'dIVA5';
/** Liquidación del IVA a la tasa del 10% - F016.*/
    case D_IVA10 = 'dIVA10';
/** Liquidación total del IVA por redondeo a la tasa del 5% - F036.*/
    case D_LIQ_TOT_IVA5 = 'dLiqTotIVA5';
/** Liquidación total del IVA por redondeo a la tasa del 10% - F037.*/
    case D_LIQ_TOT_IVA10 = 'dLiqTotIVA10';
/** Liquidación total del IVA de la comisión - F026.*/
    case D_IVA_COMI = 'dIVAComi';
/** Liquidación total del IVA - F017.*/
    case D_TOT_IVA = 'dTotIVA';
/** Total base gravada al 5% - F018.*/
    case D_BASE_GRAV5 = 'dBaseGrav5';
/** LTotal base gravada al 10% - F019.*/
    case D_BASE_GRAV10 = 'dBaseGrav10';
/** Total de la base gravada de IVA - F020.*/
    case D_T_BAS_GRAL_IVA = 'dTBasGraIVA';
/** Total general de la operación en Guraraníes - F023.*/
    case D_TOTAL_GS = 'dTotalGs';
/** @deprecated Total + comisión - F024.*/
    case D_TOT_COM = 'dTotCom';

    // Grupo H. Campos que identifican al documento asociado (H001-H049)

/** Campos que identifican al DE asociado - H001.*/
    case G_CAM_DE_ASOC = 'gCamDEAsoc';
/** Tipo de documento asociado - H002.*/
    case I_TIP_DOC_ASO = 'iTipDocAso';
/** Descripción del tipo de documento asociado - H003.*/
    case D_DES_TIP_DOC_ASO = 'dDesTipDocAso';
/** CDC del DTE referenciado - H004.*/
    case D_CDC_DE_REF = 'dCdCDERef';
/** Nro. timbrado documento impreso de referencia - H005.*/
    case D_N_TIM_DI = 'dNTimDI';
/** Establecimiento - H006.*/
    case D_EST_DOC_ASO = 'dEstDocAso';
/** Punto de Expedición - H007.*/
    case D_P_EXP_DOC_ASO = 'dPExpDocAso';
/** Número de documento - H008.*/
    case D_NUM_DOC_ASO = 'dNumDocAso';
/** Tipo de documento impreso - H009.*/
    case I_TIPO_DOC_ASO = 'iTipoDocAso';
/** Descripción del tipo de documento impreso - H010.*/
    case D_D_TIPO_DOC_ASO = 'dDTipoDocAso';
/** Fecha de emisión del documento impreso de referencia - H011.*/
    case D_FEC_EMI_DI = 'dFecEmiDI';
/** Número de comprobante de retención - H012.*/
    case D_NUM_COM_RET = 'dNumComRet';
/** Número de resolución de crédito fiscal - H013.*/
    case D_NUM_RES_CF = 'dNumResCF';
/** Tipo de constancia - H014.*/
    case I_TIP_CONS = 'iTipCons';
/** Descripción del tipo de constancia - H015.*/
    case D_DES_TIP_CONS = 'dDesTipCons';
/** Número de constancia - H016.*/
    case D_NUM_CONS = 'dNumCons';
/** Número de control de la constancia - H017.*/
    case D_NUM_CONTROL = 'dNumControl';

    // Grupo J. Campos fuera de la Firma Digital (J001-J049)

/** Campos fuera de la firma dígital - J001.*/
    case G_CAM_FU_FD = 'gCamFuFD';
/** Caracteres correspondientes al código QR - J002.*/
    case D_CAR_QR = 'dCarQR';
/** Información adicional de interés para el emisor - J003.*/
    case D_INF_ADIC = 'dInfAdic';
}
