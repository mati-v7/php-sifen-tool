<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Generator;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\Invoice;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Item;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\XmlGeneratorInterface;
use Override;

final class InvoiceXmlGenerator implements XmlGeneratorInterface
{
    #[Override]
    public function generate(object $document): string
    {
        if (! $document instanceof Invoice) {
            throw new \InvalidArgumentException('Expected Invoice instance.');
        }

        $xml = new \DOMDocument('1.0', 'UTF-8');

        $xml->formatOutput = true;

        $root = $xml->createElement('rDE');

        $xml->appendChild($root);

        $de = $xml->createElement('DE');

        $root->appendChild($de);

        $issuer = $xml->createElement('gEmis');

        $issuer->appendChild(
            $xml->createElement('dRucEm', $document->issuer()->ruc()->value())
        );

        $issuer->appendChild(
            $xml->createElement('dNomEmi', $document->issuer()->name())
        );

        $de->appendChild($issuer);

        $receiver = $xml->createElement('gDatRec');

        $receiver->appendChild(
            $xml->createElement('dNumIDRec', $document->receiver()->documentNumber())
        );

        $receiver->appendChild(
            $xml->createElement('dNomRec', $document->receiver()->name())
        );

        $de->appendChild($receiver);

        foreach ($document->items() as $item) {
            $this->appendItem($xml, $de, $item);
        }

        $totals = $xml->createElement('gTotSub');

        $totals->appendChild(
            $xml->createElement('dTotGralOpe', (string) $document->total()->amount())
        );

        $de->appendChild($totals);

        return $xml->saveXML();
    }

    private function appendItem(
        \DOMDocument $xml,
        \DOMElement $parent,
        Item $item
    ): void {
        $node = $xml->createElement('gCamItem');

        $node->appendChild(
            $xml->createElement('dDesProSer', $item->description())
        );

        $node->appendChild(
            $xml->createElement('dCantProSer', (string) $item->quantity())
        );

        $node->appendChild(
            $xml->createElement('dPUniProSer', (string) $item->unitPrice()->amount())
        );

        $node->appendChild(
            $xml->createElement('dTotOpeItem', (string) $item->total()->amount())
        );

        $parent->appendChild($node);
    }
}
