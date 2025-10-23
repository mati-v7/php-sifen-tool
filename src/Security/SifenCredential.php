<?php

namespace Nyxcode\PhpSifenTool\Security;

use Nyxcode\PhpSifenTool\Crypto\Certificate;

/**
 * Class SifenCredential
 *
 * Represents the credentials required for Sifen authentication, including a certificate,
 * security key identifier, and security key string. Provides access to certificate details
 * and SOAP options for secure communication.
 *
 * @package Security
 */
class SifenCredential
{
    /**
     * SifenCredential constructor.
     *
     * Initializes a new instance of the SifenCredential class.
     *
     * @param Certificate $certificate The certificate used for authentication.
     * @param string $idcSC The identifier for the security key.
     * @param string $csc The security key string.
     */
    public function __construct(
        private Certificate $certificate,
        private string $idcSC,
        private string $csc
    ) {
        //
    }

    public function getCertificate(): Certificate
    {
        return $this->certificate;
    }

    public function getIdcSC(): string
    {
        return $this->idcSC;
    }

    public function getCSC(): string
    {
        return $this->csc;
    }

    /**
     * @return array<string, mixed>
     */
    public function getSoapOptions(): array
    {
        return $this->certificate->getSoapOptions();
    }
}
