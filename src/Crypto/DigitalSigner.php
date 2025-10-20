<?php

namespace Nyxcode\PhpSifenTool\Crypto;

use DOMNode;
use RobRichards\XMLSecLibs\XMLSecurityDSig;
use RobRichards\XMLSecLibs\XMLSecurityKey;

class DigitalSigner implements SignerInterface
{
    private Certificate $certificate;

    public function __construct(Certificate $certificate)
    {
        $this->certificate = $certificate;
    }

    public function sign(DOMNode $xml): void
    {
        $id = $xml->attributes->getNamedItem('Id')->nodeValue ?? null;
        if (!$id) {
            throw new \RuntimeException("El elemento XML no tiene un atributo 'Id'.");
        }

        // Create a new Security object
        $dSig = new XMLSecurityDSig('');

        // Use the c14n exclusive canonicalization
        $dSig->setCanonicalMethod(XMLSecurityDSig::EXC_C14N);

        // Sign using SHA-256
        $dSig->addReference(
            $xml,
            XMLSecurityDSig::SHA256,
            ['http://www.w3.org/2000/09/xmldsig#enveloped-signature', XMLSecurityDSig::EXC_C14N],
            [
                'force_uri' => true,
                'overwrite' => false,
                'overwrite_id' => $id,
                'id_name' => 'Id'
            ]
        );

        // Create a new (private) Security key and load the private key
        $secKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, ['type' => 'private']);
        $secKey->loadKey($this->certificate->getPrivateKey(), false);

        // Sign the XML file
        $dSig->sign($secKey, $xml->parentNode);

        // Add the associated public key to the signature
        $dSig->add509Cert($this->certificate->getPublicCert());
    }
}
