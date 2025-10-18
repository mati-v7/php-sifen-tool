<?php

namespace Nyxcode\PhpSifenTool\Soap\Factory;

/**
 * Factory class for creating configured instances of SoapClient.
 */
class SoapClientFactory
{
    public static function create(string $wsdl, array $options = []): \SoapClient
    {
        return new \SoapClient(
            $wsdl,
            array_merge([
                'soap_version' => SOAP_1_2,
                'trace'        => 1,       // enable __getLastRequest() and __getLastResponse() for debugging
                'exceptions'   => true,
                'cache_wsdl' => WSDL_CACHE_NONE,
                'classmap'     => ClassMapFactory::get(),
            ], $options)
        );
    }
}
