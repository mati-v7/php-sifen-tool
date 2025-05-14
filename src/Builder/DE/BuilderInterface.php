<?php

namespace Nyxcode\PhpSifenTool\Builder\DE;

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
}
