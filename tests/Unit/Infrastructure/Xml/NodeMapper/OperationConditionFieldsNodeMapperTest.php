<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Tests\Unit\Infrastructure\Xml\NodeMapper;

use Nyxcode\PhpSifenTool\Domain\DE\Entity\PaymentCondition;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\OperationConditionType;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150\OperationConditionFieldsNodeMapper;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Writer\XmlTreeRenderer;
use Nyxcode\PhpSifenTool\Tests\Unit\Infrastructure\Xml\XmlTestCase;

final class OperationConditionFieldsNodeMapperTest extends XmlTestCase
{
    public function test_maps_cash_condition(): void
    {
        $paymentCondition = new PaymentCondition(OperationConditionType::CASH);

        $tree = (new OperationConditionFieldsNodeMapper)->map($paymentCondition);
        $xml = (new XmlTreeRenderer)->render($tree);

        $this->assertXmlPathValue('1', '/gCamCond/iCondOpe', $xml);
        $this->assertXmlPathValue('Contado', '/gCamCond/dDCondOpe', $xml);
    }

    public function test_maps_credit_condition(): void
    {
        $paymentCondition = new PaymentCondition(OperationConditionType::CREDIT);

        $tree = (new OperationConditionFieldsNodeMapper)->map($paymentCondition);
        $xml = (new XmlTreeRenderer)->render($tree);

        $this->assertXmlPathValue('2', '/gCamCond/iCondOpe', $xml);
        $this->assertXmlPathValue('Crédito', '/gCamCond/dDCondOpe', $xml);
    }
}
