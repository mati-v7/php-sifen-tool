<?php

namespace Nyxcode\PhpSifenTool\Tests\Feature;

use Nyxcode\PhpSifenTool\Crypto\Certificate;
use Nyxcode\PhpSifenTool\Crypto\DigitalSigner;
use Nyxcode\PhpSifenTool\Crypto\SignatureVerifier;
use PHPUnit\Framework\TestCase;

class SignatureTest extends TestCase
{
    private Certificate $certificate;

    protected function setUp(): void
    {
        $this->certificate = new Certificate(
            __DIR__ . '/../../.vscode/certificado.pem'
        );
    }

    public function testXmlSignatureIsValid(): void
    {
        $xmlOriginal = <<<XML
        <FacturaElectronica>
            <Id>123</Id>
            <Cliente>Juan Perez</Cliente>
        </FacturaElectronica>
        XML;

        $signer = new DigitalSigner($this->certificate);
        $xmlFirmado = $signer->sign($xmlOriginal);

        $this->assertStringContainsString('<Signature', $xmlFirmado, 'El XML debe contener una firma digital.');

        $verifier = new SignatureVerifier();
        $resultado = $verifier->verify($xmlFirmado);

        $this->assertTrue($resultado, 'La firma XML debería ser válida.');
    }

    public function testXmlSignatureFailsWhenTampered(): void
    {
        $xmlOriginal = <<<XML
        <FacturaElectronica>
            <Id>123</Id>
            <Cliente>Juan Perez</Cliente>
        </FacturaElectronica>
        XML;

        $signer = new DigitalSigner($this->certificate);
        $xmlFirmado = $signer->sign($xmlOriginal);

        // Modificar el XML después de firmar
        $xmlModificado = str_replace('Juan Perez', 'Pedro López', $xmlFirmado);

        $verifier = new SignatureVerifier();
        $resultado = $verifier->verify($xmlModificado);

        $this->assertFalse($resultado, 'La firma debería ser inválida si el XML fue modificado.');
    }
}
