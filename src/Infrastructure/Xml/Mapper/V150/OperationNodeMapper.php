<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\Operation;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Contracts\XmlNodeMapperInterface;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Support\XmlElement;
use Override;

final class OperationNodeMapper implements XmlNodeMapperInterface
{
    #[Override]
    public static function supports(): string
    {
        return Operation::class;
    }

    public function map(Operation $operation): XmlElement
    {
        $node = XmlElement::make('gOpeDE');

        $node->addChild(
            XmlElement::make(
                'iTipEmi',
                (string) $operation->emissionType()->value
            )
        );

        $node->addChild(
            XmlElement::make(
                'dDesTipEmi',
                $operation->emissionType()->description()
            )
        );

        $node->addChild(
            XmlElement::make(
                'dCodSeg',
                $operation->securityCode()->value()
            )
        );

        if ($operation->issuerInfo()) {
            $node->addChild(
                XmlElement::make(
                    'dInfoEmi',
                    $operation->issuerInfo()
                )
            );
        }

        if ($operation->fiscalInfo()) {
            $node->addChild(
                XmlElement::make(
                    'dInfoFisc',
                    $operation->fiscalInfo()
                )
            );
        }

        return $node;
    }
}
