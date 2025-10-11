<?php

namespace Nyxcode\PhpSifenTool\Crypto;

class Certificate
{
    private string $path;
    private ?string $keyPath;
    private ?string $password;
    private string $privateKey;
    private string $publicCert;
    private ?string $serialNumber = null;


    public function __construct(
        string $path,
        ?string $password = null,
        ?string $keyPath = null
    ) {
        $this->path = $path;
        $this->password = $password;
        $this->keyPath = $keyPath;

        $this->load();
    }

    private function load(): void
    {
        if (!file_exists($this->path)) {
            throw new \RuntimeException("No se encontró el archivo de certificado: {$this->path}");
        }

        $extension = strtolower(pathinfo($this->path, PATHINFO_EXTENSION));

        switch ($extension) {
            case 'p12':
            case 'pfx':
                $this->loadPkcs12();
                break;

            case 'pem':
                $this->loadPem();
                break;

            default:
                throw new \RuntimeException("Tipo de certificado no soportado: .{$extension}");
        }
    }

    private function loadPkcs12(): void
    {
        $content = file_get_contents($this->path);
        $certs = [];

        if (!openssl_pkcs12_read($content, $certs, $this->password ?? '')) {
            throw new \RuntimeException("No se pudo leer el archivo PKCS#12 (.p12/.pfx) o la contraseña es incorrecta.");
        }

        $this->privateKey = $certs['pkey'];
        $this->publicCert = $certs['cert'];

        $parsed = openssl_x509_parse($this->publicCert);
        if (isset($parsed['serialNumberHex'])) {
            $this->serialNumber = $parsed['serialNumberHex'];
        }
    }

    private function loadPem(): void
    {
        // Caso 1: PEM unificado (cert + key en un solo archivo)
        $content = file_get_contents($this->path);

        $hasPrivateKey = str_contains($content, '-----BEGIN PRIVATE KEY-----');
        $hasCert = str_contains($content, '-----BEGIN CERTIFICATE-----');

        if ($hasPrivateKey && $hasCert) {
            $this->extractPemParts($content);
            return;
        }

        // Caso 2: PEMs separados (cert.pem y key.pem)
        if ($this->keyPath && file_exists($this->keyPath)) {
            $this->publicCert = file_get_contents($this->path);
            $this->privateKey = file_get_contents($this->keyPath);
        } else {
            throw new \RuntimeException("Se detectó formato PEM, pero no se encontró clave privada o no se pudo leer.");
        }

        $parsed = openssl_x509_parse($this->publicCert);
        if (isset($parsed['serialNumberHex'])) {
            $this->serialNumber = $parsed['serialNumberHex'];
        }
    }

    private function extractPemParts(string $content): void
    {
        // Extraer clave privada
        if (preg_match('/-----BEGIN PRIVATE KEY-----(.*?)-----END PRIVATE KEY-----/s', $content, $matches)) {
            $this->privateKey = "-----BEGIN PRIVATE KEY-----\n" . trim($matches[1]) . "\n-----END PRIVATE KEY-----";
        } else {
            throw new \RuntimeException("No se encontró clave privada en el archivo PEM unificado.");
        }

        // Extraer certificado
        if (preg_match('/-----BEGIN CERTIFICATE-----(.*?)-----END CERTIFICATE-----/s', $content, $matches)) {
            $this->publicCert = "-----BEGIN CERTIFICATE-----\n" . trim($matches[1]) . "\n-----END CERTIFICATE-----";
        } else {
            throw new \RuntimeException("No se encontró certificado público en el archivo PEM unificado.");
        }

        $parsed = openssl_x509_parse($this->publicCert);
        if (isset($parsed['serialNumberHex'])) {
            $this->serialNumber = $parsed['serialNumberHex'];
        }
    }

    public function getPrivateKey(): string
    {
        return $this->privateKey;
    }

    public function getPublicCert(): string
    {
        return $this->publicCert;
    }

    public function getSerialNumber(): ?string
    {
        return $this->serialNumber;
    }
}
