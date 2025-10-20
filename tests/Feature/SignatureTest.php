<?php

namespace Nyxcode\PhpSifenTool\Tests\Feature;

use DOMDocument;
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
        <DocumentoElectronico>
            <Factura Id="12345">
                <Id>123</Id>
                <Cliente>Juan Perez</Cliente>
            </Factura>
        </DocumentoElectronico>
        XML;

        $dom = new DOMDocument();
        $dom->loadXML($xmlOriginal);

        $signer = new DigitalSigner($this->certificate);
        $signer->sign($dom->getElementsByTagName('Factura')->item(0));
        $xmlFirmado = $dom->saveXML();

        $this->assertStringContainsString('<Signature', $xmlFirmado, 'El XML debe contener una firma digital.');

        $verifier = new SignatureVerifier();
        $resultado = $verifier->verify($xmlFirmado);

        $this->assertTrue($resultado, 'La firma XML debería ser válida.');
    }

    public function testXmlSignatureFailsWhenTampered(): void
    {
        $xmlOriginal = <<<XML
        <DocumentoElectronico>
            <Factura Id="12345">
                <Id>123</Id>
                <Cliente>Juan Perez</Cliente>
            </Factura>
        </DocumentoElectronico>
        XML;

        $dom = new DOMDocument();
        $dom->loadXML($xmlOriginal);

        $signer = new DigitalSigner($this->certificate);
        $signer->sign($dom->getElementsByTagName('Factura')->item(0));
        $xmlFirmado = $dom->saveXML();

        // Modificar el XML después de firmar
        $xmlModificado = str_replace('Juan Perez', 'Pedro López', $xmlFirmado);

        try {
            $verifier = new SignatureVerifier();
            $valid = $verifier->verify($xmlModificado);

            $this->assertFalse($valid, 'La firma XML debería ser inválida después de modificar el contenido.');
        } catch (\Exception $th) {
            $this->assertTrue(true, 'Se lanzó una excepción al verificar una firma inválida: ' . $th->getMessage());
        }
    }
}
