<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\ElectronicDocument;
use Nyxcode\PhpSifenTool\Infrastructure\Catalog\Country\JsonCountryCatalog;
use Nyxcode\PhpSifenTool\Infrastructure\Catalog\Geographic\JsonGeographicCatalog;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\XmlNodeMapperInterface;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150\Composite\CompositeReceiverDocumentNodeMapper;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;
use Override;

final class GeneralOperationDataNodeMapper implements XmlNodeMapperInterface
{
    #[Override]
    public static function supports(): string
    {
        return ElectronicDocument::class;
    }

    public function map(ElectronicDocument $document): XmlElement
    {
        $node = XmlElement::make('gDatGralOpe');
        $catalogDirectory = dirname(__DIR__, 4).'/Resources/catalog';

        $node->addChild(
            XmlElement::make(
                'dFeEmiDE',
                $document->issuedAt()->format('Y-m-d\TH:i:s')
            )
        );

        $geographicCatalog = new JsonGeographicCatalog($catalogDirectory);

        $node->addChild(
            (new IssuerNodeMapper($geographicCatalog))
                ->map($document->issuer())
        );

        $node->addChild(
            (new ReceiverNodeMapper(
                new JsonCountryCatalog($catalogDirectory),
                $geographicCatalog,
                new CompositeReceiverDocumentNodeMapper([
                    new TaxpayerDocumentNodeMapper,
                    new IdentityDocumentNodeMapper,
                ]),
                new ReceiverAddressNodeMapper,
                new ReceiverContactNodeMapper
            ))
                ->map($document->receiver())
        );

        return $node;
    }
}
