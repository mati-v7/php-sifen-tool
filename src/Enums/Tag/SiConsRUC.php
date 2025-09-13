<?php

namespace Nyxcode\PhpSifenTool\Enums\Tag;

/**
 * Enum SiConsRUC
 *
 * Represents the tags used for RUC (Registro Único de Contribuyentes) related operations.
 */
enum SiConsRUC: string
{
/** Raiz */
    case R_ENVI_CONS_RUC = 'rEnviConsRUC';
/** Identificador de control de envío */
    case D_ID = 'dId';
/** RUC consultado */
    case D_RUC_CONS = 'dRUCCons';
}
