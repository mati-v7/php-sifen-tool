<?php

namespace Nyxcode\PhpSifenTool\Crypto;

use DOMDocument;
use RobRichards\XMLSecLibs\XMLSecurityDSig;

class SignatureVerifier
{
    public function verify(string $xml): bool
    {
        $doc = new DOMDocument();
        $doc->loadXML($xml);

        $signatureNodes = $doc->getElementsByTagName('Signature');
        if ($signatureNodes->length === 0) {
            throw new \RuntimeException("El documento no contiene un nodo <Signature>.");
        }

        $dSig = new XMLSecurityDSig('');
        $dSig->locateSignature($doc);
        if ($dSig == null) {
            throw new \RuntimeException("Cannot locate Signature Node");
        }

        $dSig->canonicalizeSignedInfo();
        return $dSig->validateReference();
    }
}
