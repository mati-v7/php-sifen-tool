<?php

namespace Nyxcode\PhpSifenTool\Crypto;

use DOMDocument;
use RobRichards\XMLSecLibs\XMLSecurityDSig;
use RobRichards\XMLSecLibs\XMLSecurityKey;

class DigitalSigner implements SignerInterface
{

    private Certificate $certificate;

    public function __construct(Certificate $certificate)
    {
        $this->certificate = $certificate;
    }

    private function loadXML($xml): DOMDocument
    {
        $doc = new DOMDocument('1.0', 'UTF-8');
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = false;
        $doc->loadXML($xml);

        return $doc;
    }

    public function sign(string $xml)
    {
        $doc = $this->loadXML($xml);

        // Create a new Security object
        $dSig = new XMLSecurityDSig('');

        // Use the c14n exclusive canonicalization
        $dSig->setCanonicalMethod(XMLSecurityDSig::EXC_C14N);

        // Sign using SHA-256
        $dSig->addReference(
            $doc->documentElement,
            XMLSecurityDSig::SHA256,
            ['http://www.w3.org/2000/09/xmldsig#enveloped-signature', XMLSecurityDSig::EXC_C14N]
        );

        // Create a new (private) Security key and load the private key
        $secKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, ['type' => 'private']);
        $secKey->loadKey($this->certificate->getPrivateKey(), false);

        // Sign the XML file
        $dSig->sign($secKey, $doc->documentElement);

        // Add the associated public key to the signature
        $dSig->add509Cert($this->certificate->getPublicCert());

        return $doc->saveXML();
    }
}
