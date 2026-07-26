<?php

namespace Nyxcode\PhpSifenTool\Tests\Unit\Infrastructure\Xml\NodeMapper;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\SecurityCode;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Operation;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\EmissionType;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150\OperationNodeMapper;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Writer\XmlTreeRenderer;
use Nyxcode\PhpSifenTool\Tests\Unit\Infrastructure\Xml\XmlTestCase;

final class OperationNodeMapperTest extends XmlTestCase
{

    public function test_maps_required_operation_fields(): void
    {

        $operation = new Operation(
            EmissionType::NORMAL,
            new SecurityCode('123456789'),
            null,
            null
        );

        $operationNode = new OperationNodeMapper();
        $tree = $operationNode->map($operation);
        $xml = (new XmlTreeRenderer)
            ->render($tree);

        $this->assertXmlPathValue('1', '/gOpeDE/iTipEmi', $xml);
        $this->assertXmlPathValue('Normal', '/gOpeDE/dDesTipEmi', $xml);
        $this->assertXmlPathValue('123456789', '/gOpeDE/dCodSeg', $xml);
    }

    public function test_maps_issuer_info(): void
    {
        $operation = new Operation(
            EmissionType::NORMAL,
            new SecurityCode('123456789'),
            'Issuer information',
            null
        );

        $operationNode = new OperationNodeMapper();
        $tree = $operationNode->map($operation);
        $xml = (new XmlTreeRenderer)
            ->render($tree);

        $this->assertXmlPathValue('Issuer information', '/gOpeDE/dInfoEmi', $xml);
    }

    public function test_maps_fiscal_info(): void
    {
        $operation = new Operation(
            EmissionType::NORMAL,
            new SecurityCode('123456789'),
            null,
            'Fiscal information'
        );

        $operationNode = new OperationNodeMapper();
        $tree = $operationNode->map($operation);
        $xml = (new XmlTreeRenderer)
            ->render($tree);

        $this->assertXmlPathValue('Fiscal information', '/gOpeDE/dInfoFisc', $xml);
    }

    public function test_does_not_generate_information_fields(): void
    {
        $operation = new Operation(
            EmissionType::NORMAL,
            new SecurityCode('123456789'),
            null,
            null
        );

        $operationNode = new OperationNodeMapper();
        $tree = $operationNode->map($operation);
        $xml = (new XmlTreeRenderer)
            ->render($tree);

        $this->assertNull($this->evaluateXPath($xml, '/gOpeDE/dInfoEmi'));
        $this->assertNull($this->evaluateXPath($xml, '/gOpeDE/dInfoFisc'));
    }
}
