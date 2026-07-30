<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Tests\Unit\Infrastructure\Xml\NodeMapper;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Money;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\CashPayment;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\PaymentCondition;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\OperationConditionType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\PaymentType;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Mapper\V150\OperationConditionFieldsNodeMapper;
use Nyxcode\PhpSifenTool\Infrastructure\Xml\Writer\XmlTreeRenderer;
use Nyxcode\PhpSifenTool\Tests\Unit\Infrastructure\Xml\XmlTestCase;

final class OperationConditionFieldsNodeMapperTest extends XmlTestCase
{
    public function test_maps_cash_condition(): void
    {
        $paymentCondition = new PaymentCondition(
            OperationConditionType::CASH,
            [new CashPayment(PaymentType::CASH, Money::guaranies('100000'))]
        );

        $tree = (new OperationConditionFieldsNodeMapper)->map($paymentCondition);
        $xml = (new XmlTreeRenderer)->render($tree);

        $this->assertXmlPathValue('1', '/gCamCond/iCondOpe', $xml);
        $this->assertXmlPathValue('Contado', '/gCamCond/dDCondOpe', $xml);
        $this->assertXmlPathValue('1', '/gCamCond/gPaConEIni/iTiPago', $xml);
        $this->assertXmlPathValue('Efectivo', '/gCamCond/gPaConEIni/dDesTiPag', $xml);
        $this->assertXmlPathValue('100000', '/gCamCond/gPaConEIni/dMonTiPag', $xml);
        $this->assertXmlPathValue('PYG', '/gCamCond/gPaConEIni/cMoneTiPag', $xml);
        $this->assertXmlPathValue('Guarani', '/gCamCond/gPaConEIni/dDMoneTiPag', $xml);
    }

    public function test_maps_credit_condition(): void
    {
        $paymentCondition = new PaymentCondition(OperationConditionType::CREDIT);

        $tree = (new OperationConditionFieldsNodeMapper)->map($paymentCondition);
        $xml = (new XmlTreeRenderer)->render($tree);

        $this->assertXmlPathValue('2', '/gCamCond/iCondOpe', $xml);
        $this->assertXmlPathValue('Crédito', '/gCamCond/dDCondOpe', $xml);
    }

    public function test_maps_cash_payment_with_foreign_currency_and_exchange_rate(): void
    {
        $paymentCondition = new PaymentCondition(
            OperationConditionType::CASH,
            [
                new CashPayment(
                    type: PaymentType::TRANSFER,
                    amount: Money::fromAmount('100', 'USD'),
                    exchangeRate: '7300.5'
                ),
            ]
        );

        $tree = (new OperationConditionFieldsNodeMapper)->map($paymentCondition);
        $xml = (new XmlTreeRenderer)->render($tree);

        $this->assertXmlPathValue('5', '/gCamCond/gPaConEIni/iTiPago', $xml);
        $this->assertXmlPathValue('Transferencia', '/gCamCond/gPaConEIni/dDesTiPag', $xml);
        $this->assertXmlPathValue('USD', '/gCamCond/gPaConEIni/cMoneTiPag', $xml);
        $this->assertXmlPathValue('7300.5', '/gCamCond/gPaConEIni/dTiCamTiPag', $xml);
    }

    public function test_maps_cash_payment_with_custom_description_for_other_type(): void
    {
        $paymentCondition = new PaymentCondition(
            OperationConditionType::CASH,
            [
                new CashPayment(
                    type: PaymentType::OTHER,
                    amount: Money::guaranies('50000'),
                    customDescription: 'Puntos de fidelidad'
                ),
            ]
        );

        $tree = (new OperationConditionFieldsNodeMapper)->map($paymentCondition);
        $xml = (new XmlTreeRenderer)->render($tree);

        $this->assertXmlPathValue('99', '/gCamCond/gPaConEIni/iTiPago', $xml);
        $this->assertXmlPathValue('Puntos de fidelidad', '/gCamCond/gPaConEIni/dDesTiPag', $xml);
    }
}
