<?php

namespace Nyxcode\PhpSifenTool\Enums\Soap;

/**
 * Enum Host
 *
 * Represents the environments available for the SIFEN SOAP service.
 */
enum Host: string
{
    /** Produccón */
    public const PRODUCTION = 'https://sifen.set.gov.py';
    /** Testing */
    public const TESTING = 'https://sifen-test.set.gov.py';
}
