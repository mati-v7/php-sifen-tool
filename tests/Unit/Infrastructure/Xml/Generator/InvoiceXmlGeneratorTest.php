<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Tests\Unit\Infrastructure\Xml\Generator;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Money;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Percentage;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Ruc;
use Nyxcode\PhpSifenTool\Domain\DE\Builder\InvoiceBuilder;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Invoice;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Issuer;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Item;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Receiver;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Generator\InvoiceXmlGenerator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class InvoiceXmlGeneratorTest extends TestCase
{
    #[DataProvider('buildSampleInvoice')]
    public function test_generate_with_valid_invoice_returns_xml_string(Invoice $invoice): void
    {
        $generator = new InvoiceXmlGenerator;

        $xmlString = $generator->generate($invoice);

        $this->assertIsString($xmlString);
        $this->assertStringContainsString('<rDE>', $xmlString);
        $this->assertStringContainsString('<DE>', $xmlString);
        $this->assertStringContainsString('<gEmis>', $xmlString);
        $this->assertStringContainsString('<dRucEm>1234567-9</dRucEm>', $xmlString);
        $this->assertStringContainsString('<dNomEmi>ACME Corp</dNomEmi>', $xmlString);
        $this->assertStringContainsString('<gDatRec>', $xmlString);
        $this->assertStringContainsString('<dNumIDRec>987654321</dNumIDRec>', $xmlString);
        $this->assertStringContainsString('<dNomRec>John Doe</dNomRec>', $xmlString);
        $this->assertStringContainsString('<gCamItem>', $xmlString);
        $this->assertStringContainsString('<dDesProSer>Product 1</dDesProSer>', $xmlString);
        $this->assertStringContainsString('<dCantProSer>2</dCantProSer>', $xmlString);
        $this->assertStringContainsString('<dPUniProSer>10</dPUniProSer>', $xmlString);
        $this->assertStringContainsString('<dTotOpeItem>20</dTotOpeItem>', $xmlString);
        $this->assertStringContainsString('<dDesProSer>Product 2</dDesProSer>', $xmlString);
        $this->assertStringContainsString('<dCantProSer>1</dCantProSer>', $xmlString);
        $this->assertStringContainsString('<dPUniProSer>20</dPUniProSer>', $xmlString);
        $this->assertStringContainsString('<dTotOpeItem>20</dTotOpeItem>', $xmlString);
        $this->assertStringContainsString('<gTotSub>', $xmlString);
        $this->assertStringContainsString('<dTotGralOpe>40</dTotGralOpe>', $xmlString);
    }

    public static function buildSampleInvoice(): array
    {
        $issuer = new Issuer(
            ruc: new Ruc('1234567-9'),
            name: 'ACME Corp',
        );

        $receiver = new Receiver(
            documentNumber: '987654321',
            name: 'John Doe',
        );

        $item1 = new Item(
            description: 'Product 1',
            quantity: 2,
            unitPrice: Money::guaranies('10.0'),
            vatPercentage: new Percentage(10)
        );

        $item2 = new Item(
            description: 'Product 2',
            quantity: 1,
            unitPrice: Money::guaranies('20.0'),
            vatPercentage: new Percentage(10)
        );

        $invoice = InvoiceBuilder::make()
            ->issuer($issuer)
            ->receiver($receiver)
            ->addItem($item1)
            ->addItem($item2)
            ->build();

        return [
            'invoice' => [$invoice],
        ];
    }
}
