<?php

namespace Nyxcode\PhpSifenTool\Crypto;

use DOMDocument;
use RobRichards\XMLSecLibs\XMLSecurityDSig;

class SignatureVerifier
{
    public function verify(string $xml)
    {
        $doc = new DOMDocument();
        $doc->loadXML($xml);

        $signatureNodes = $doc->getElementsByTagName('Signature');
        if ($signatureNodes->length === 0) {
            throw new \RuntimeException("El documento no contiene un nodo <Signature>.");
        }

        $dSig = new XMLSecurityDSig('');
        $dSig->locateSignature($doc);
        $dSig->canonicalizeSignedInfo();

        $objKey = $dSig->locateKey();
        if (!$objKey) {
            throw new \RuntimeException("No se encontró clave pública en la firma XML.");
        }

        $isValid = $dSig->verify($objKey);
        return $isValid;
    }
}
