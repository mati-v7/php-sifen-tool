<?php

namespace Nyxcode\PhpSifenTool\Builder\Contracts;

use DOMElement;

/**
 * Interface DEBuildable
 *
 * Defines the contract for building different groups of data fields for an Electronic Document (Documento Electrónico).
 */
interface DEBuildable
{
    public function reset(): void;

    public function getResult(): DOMElement;

    /**
     * Grupo A. Campos firmados del Documento Electrónico
     * @param array<mixed> $data
     */
    public function setGroupA(array $data): void;
    /**
     * Grupo B. Campos inherentes a la operación de Documentos Electrónicos
     * @param array<mixed> $data
     */
    public function setGroupB(array $data): void;
    /**
     * Grupo C. Campos de Datos del Timbrado
     * @param array<mixed> $data
     */
    public function setGroupC(array $data): void;
    /**
     * Grupo D. Campos Generales del Documento Electrónico
     * @param array<mixed> $data
     */
    public function setGroupD(array $data): void;
    /**
     * Grupo D.1. Campos inherentes a la operación comercial
     * @param array<mixed> $data
     */
    public function setGroupD1(array $data): void;
    /**
     * Grupo D.2. Campos que identifican al emisor del Documento electrónico
     * @param array<mixed> $data
     */
    public function setGroupD2(array $data): void;
    /**
     * Grupo D.2.1. Campos que describen la actividad económica del emisor
     * @param array<mixed> $data
     */
    public function setGroupD21(array $data): void;
    /**
     * Grupo D.2.2. Campos que identifican al responsable de la generación del DE
     * @param array<mixed> $data
     */
    public function setGroupD22(array $data): void;
    /**
     * Grupo D.3. Campos que identifican al receptor del Documento Electrónico
     * @param array<mixed> $data
     */
    public function setGroupD3(array $data): void;
    /**
     * Grupo E. Campos especificos por tipo de Documento Electrónico
     * @param array<mixed> $data
     */
    public function setGroupE(array $data): void;
    /**
     * Grupo E.1. Campos que componen la Factura Electrónica FE
     * @param array<mixed> $data
     */
    public function setGroupE1(array $data): void;
    /**
     * Grupo E.1.1. Campos de informaciones de Compras Públicas
     * @param array<mixed> $data
     */
    public function setGroupE11(array $data): void;
    /**
     * Grupo E.7. Campos que describen la condición de la operación
     * @param array<mixed> $data
     */
    public function setGroupE7(array $data): void;
    /**
     * Grupo E7.1. Campos que describen la forma de pago de la operación al contado o del monto de la entrega inicial.
     * @param array<mixed> $data
     */
    public function setGroupE71(array $data): void;
    /**
     * Grupo E7.1.1. Campos que describen el pago o entrega inicial de la operación con tarjeta de crédito/débito
     * @param array<mixed> $data
     */
    public function setGroupE711(array $data): void;
    /**
     * Grupo E7.1.2. Campos que describen el pago o entrega inicial de la operación con cheque
     * @param array<mixed> $data
     */
    public function setGroupE712(array $data): void;
    /**
     * Grupo E7.2. Campos que describen la operación a crédito
     * @param array<mixed> $data
     */
    public function setGroupE72(array $data): void;
    /**
     * Grupo E7.2.1 Campos que describen las cuotas
     * @param array<mixed> $data
     */
    public function setGroupE721(array $data): void;
    /**
     * Grupo E8. Campos que describen los ítems de la operación
     * @param array<mixed> $data
     */
    public function setGroupE8(array $data): void;
    /**
     * Grupo E8.1 Campos que describen el precio, tipo de cambio y valor total de la operación por ítem.
     * @param array<mixed> $data
     */
    public function setGroupE81(array $data): void;
    /**
     * Grupo E8.1.1 Campos que describen los descuentos, anticipos y valor total por ítem.
     * @param array<mixed> $data
     */
    public function setGroupE811(array $data): void;
    /**
     * Grupo E8.2 Campos que describen el IVA de la operación por ítem.
     * @param array<mixed> $data
     */
    public function setGroupE82(array $data): void;
    /**
     * Grupo F Campos que describen los subtotales y totales de la transacción documentada.
     * @param array<mixed> $data
     */
    public function setGroupF(array $data): void;
    /**
     * Grupo H. Campos que identifican al documento asociado.
     * @param array<mixed> $data
     */
    public function setGroupH(array $data): void;
}
