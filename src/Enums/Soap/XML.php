<?php

namespace Nyxcode\PhpSifenTool\Enums\Soap;

enum XML
{
    /**
     * XML Namespace for SIFEN SOAP messages
     * @var string
     */
    public const XML_NS = "http://ekuatia.set.gov.py/sifen/xsd";
    /**
     * XML Schema Instance Namespace
     * @var string
     */
    public const XSI_NS = "http://www.w3.org/2001/XMLSchema-instance";
    /**
     * XML Schema Location for SIFEN SOAP messages
     * @var string
     */
    public const XSI_SCHEMA_LOCATION = "http://ekuatia.set.gov.py/sifen/xsd siRecepDE_v150.xsd";
}
