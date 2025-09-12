<?php

namespace Nyxcode\PhpSifenTool\Builder\DE;

/**
 * Interface BuilderInterface
 *
 * Defines the contract for building different groups of data fields for an Electronic Document (Documento Electrónico).
 */
interface BuilderInterface
{
    public function reset();
    public function getResult();
    /**
     * Grupo A. Campos firmados del Documento Electrónico
     */
    public function setGroupA($data);
    /**
     * Grupo B. Campos inherentes a la operación de Documentos Electrónicos
     */
    public function setGroupB($data);
    /**
     * Grupo C. Campos de Datos del Timbrado
     */
    public function setGroupC($data);
    /**
     * Grupo D. Campos Generales del Documento Electrónico
     */
    public function setGroupD($data);
    /**
     * Grupo D.1. Campos inherentes a la operación comercial
     */
    public function setGroupD1($data);
    /**
     * Grupo D.2. Campos que identifican al emisor del Documento electrónico
     */
    public function setGroupD2($data);
    /**
     * Grupo D.2.1. Campos que describen la actividad económica del emisor
     */
    public function setGroupD21($data);
    /**
     * Grupo D.2.2. Campos que identifican al responsable de la generación del DE 
     */
    public function setGroupD22($data);
    /**
     * Grupo D.3. Campos que identifican al receptor del Documento Electrónico
     */
    public function setGroupD3($data);
    /**
     * Grupo E. Campos especificos por tipo de Documento Electrónico
     */
    public function setGroupE($data);
    /**
     * Grupo E.1. Campos que componen la Factura Electrónica FE
     */
    public function setGroupE1($data);
    /**
     * Grupo E.1.1. Campos de informaciones de Compras Públicas
     */
    public function setGroupE11($data);
    /**
     * Grupo E.7. Campos que describen la condición de la operación 
     */
    public function setGroupE7($data);
    /**
     * Grupo E7.1. Campos que describen la forma de pago de la operación al contado o del monto de la entrega inicial.
     */
    public function setGroupE71($data);
    /**
     * Grupo E7.1.1. Campos que describen el pago o entrega inicial de la operación con tarjeta de crédito/débito
     */
    public function setGroupE711($data);
    /**
     * Grupo E7.1.2. Campos que describen el pago o entrega inicial de la operación con cheque
     */
    public function setGroupE712($data);
    /**
     * Grupo E7.2. Campos que describen la operación a crédito 
     */
    public function setGroupE72($data);
    /**
     * Grupo E7.2.1 Campos que describen las cuotas 
     */
    public function setGroupE721($data);
    /**
     * Grupo E8. Campos que describen los ítems de la operación
     */
    public function setGroupE8($data);
    /**
     * Grupo E8.1 Campos que describen el precio, tipo de cambio y valor total de la operación por ítem.
     */
    public function setGroupE81($data);
    /**
     * Grupo E8.1.1 Campos que describen los descuentos, anticipos y valor total por ítem.
     */
    public function setGroupE811($data);
    /**
     * Grupo E8.2 Campos que describen el IVA de la operación por ítem.
     */
    public function setGroupE82($data);
}
