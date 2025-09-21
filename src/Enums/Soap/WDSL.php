<?php

namespace Nyxcode\PhpSifenTool\Enums\Soap;

/**
 * Enum WDSL
 *
 * Defines the available WSDL endpoint paths for SIFEN SOAP web services.
 */
enum WDSL: string
{
    /** Web Service Recepción DE Sincrónico */
    public const WS_SYNC_RECIBE_DE_PATH = '/de/ws/sync/recibe.wsdl?wsdl';
    /** Web Service Recepción Lote DE Asincrónico */
    public const WS_ASYNC_RECIBE_LOTE_PATH = '/de/ws/async/recibe-lote.wsdl?wsdl';
    /** Web Service Recepción evento */
    public const WS_EVENTO_PATH = '/de/ws/eventos/evento.wsdl?wsdl';
    /** Web Service Consulta de Lote DE Asincrónico */
    public const WS_CONSULTAS_CONSULTA_LOTE_PATH = '/de/ws/consultas/consulta-lote.wsdl?wsdl';
    /** Web Service Consulta de RUC */
    public const WS_CONSULTAS_CONSULTA_RUC_PATH = '/de/ws/consultas/consulta-ruc.wsdl?wsdl';
    /** Web Service Consulta de DE */
    public const WS_CONSULTAS_CONSULTA_DE_PATH = '/de/ws/consultas/consulta.wsdl?wsdl';
}
