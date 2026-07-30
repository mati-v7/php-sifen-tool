<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Tests\Unit\Infrastructure\Xml\NodeMapper;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Money;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\Ruc;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\CardPayment;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\CashPayment;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\ChequePayment;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\CreditOperation;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\Installment;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\PaymentCondition;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\CardBrand;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\CardPaymentProcessingType;
use Nyxcode\PhpSifenTool\Domain\DE\Enum\CreditConditionType;
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

    public function test_maps_card_payment_data_for_credit_card_payment(): void
    {
        $paymentCondition = new PaymentCondition(
            OperationConditionType::CASH,
            [
                new CashPayment(
                    type: PaymentType::CREDIT_CARD,
                    amount: Money::guaranies('100000'),
                    cardPayment: new CardPayment(
                        brand: CardBrand::VISA,
                        processingType: CardPaymentProcessingType::POS,
                        processorBusinessName: 'Procesadora S.A.',
                        processorRuc: new Ruc('1234567', 6),
                        authorizationCode: '123456',
                        holderName: 'John Doe',
                        cardNumber: '1234',
                    ),
                ),
            ]
        );

        $tree = (new OperationConditionFieldsNodeMapper)->map($paymentCondition);
        $xml = (new XmlTreeRenderer)->render($tree);

        $this->assertXmlPathValue('1', '/gCamCond/gPaConEIni/gPagTarCD/iDenTarj', $xml);
        $this->assertXmlPathValue('Visa', '/gCamCond/gPaConEIni/gPagTarCD/dDesDenTarj', $xml);
        $this->assertXmlPathValue('Procesadora S.A.', '/gCamCond/gPaConEIni/gPagTarCD/dRSProTar', $xml);
        $this->assertXmlPathValue('1234567', '/gCamCond/gPaConEIni/gPagTarCD/dRUCProTar', $xml);
        $this->assertXmlPathValue('6', '/gCamCond/gPaConEIni/gPagTarCD/dDVProTar', $xml);
        $this->assertXmlPathValue('1', '/gCamCond/gPaConEIni/gPagTarCD/iForProPa', $xml);
        $this->assertXmlPathValue('123456', '/gCamCond/gPaConEIni/gPagTarCD/dCodAuOpe', $xml);
        $this->assertXmlPathValue('John Doe', '/gCamCond/gPaConEIni/gPagTarCD/dNomTit', $xml);
        $this->assertXmlPathValue('1234', '/gCamCond/gPaConEIni/gPagTarCD/dNumTarj', $xml);
    }

    public function test_maps_card_payment_with_custom_description_for_other_brand(): void
    {
        $paymentCondition = new PaymentCondition(
            OperationConditionType::CASH,
            [
                new CashPayment(
                    type: PaymentType::DEBIT_CARD,
                    amount: Money::guaranies('50000'),
                    cardPayment: new CardPayment(
                        brand: CardBrand::OTHER,
                        processingType: CardPaymentProcessingType::ELECTRONIC_PAYMENT,
                        customBrandDescription: 'Tarjeta regional',
                    ),
                ),
            ]
        );

        $tree = (new OperationConditionFieldsNodeMapper)->map($paymentCondition);
        $xml = (new XmlTreeRenderer)->render($tree);

        $this->assertXmlPathValue('99', '/gCamCond/gPaConEIni/gPagTarCD/iDenTarj', $xml);
        $this->assertXmlPathValue('Tarjeta regional', '/gCamCond/gPaConEIni/gPagTarCD/dDesDenTarj', $xml);
        $this->assertXmlPathValue('2', '/gCamCond/gPaConEIni/gPagTarCD/iForProPa', $xml);
    }

    public function test_maps_cheque_payment_data_for_cheque_payment(): void
    {
        $paymentCondition = new PaymentCondition(
            OperationConditionType::CASH,
            [
                new CashPayment(
                    type: PaymentType::CHECK,
                    amount: Money::guaranies('100000'),
                    chequePayment: new ChequePayment(
                        number: '1234',
                        issuingBank: 'Banco S.A.',
                    ),
                ),
            ]
        );

        $tree = (new OperationConditionFieldsNodeMapper)->map($paymentCondition);
        $xml = (new XmlTreeRenderer)->render($tree);

        $this->assertXmlPathValue('00001234', '/gCamCond/gPaConEIni/gPagCheq/dNumCheq', $xml);
        $this->assertXmlPathValue('Banco S.A.', '/gCamCond/gPaConEIni/gPagCheq/dBcoEmi', $xml);
    }

    public function test_maps_credit_operation_with_term(): void
    {
        $paymentCondition = new PaymentCondition(
            OperationConditionType::CREDIT,
            [],
            new CreditOperation(
                conditionType: CreditConditionType::TERM,
                term: '30 días',
                initialPayment: Money::guaranies('50000'),
            )
        );

        $tree = (new OperationConditionFieldsNodeMapper)->map($paymentCondition);
        $xml = (new XmlTreeRenderer)->render($tree);

        $this->assertXmlPathValue('1', '/gCamCond/gPagCred/iCondCred', $xml);
        $this->assertXmlPathValue('Plazo', '/gCamCond/gPagCred/dDCondCred', $xml);
        $this->assertXmlPathValue('30 días', '/gCamCond/gPagCred/dPlazoCre', $xml);
        $this->assertXmlPathValue('50000', '/gCamCond/gPagCred/dMonEnt', $xml);
    }

    public function test_maps_credit_operation_with_installments(): void
    {
        $paymentCondition = new PaymentCondition(
            OperationConditionType::CREDIT,
            [],
            new CreditOperation(
                conditionType: CreditConditionType::INSTALLMENT,
                installmentsCount: 2,
                installments: [
                    new Installment(
                        amount: Money::guaranies('25000'),
                        dueDate: new \DateTimeImmutable('2026-08-30')
                    ),
                    new Installment(amount: Money::guaranies('25000')),
                ],
            )
        );

        $tree = (new OperationConditionFieldsNodeMapper)->map($paymentCondition);
        $xml = (new XmlTreeRenderer)->render($tree);

        $this->assertXmlPathValue('2', '/gCamCond/gPagCred/iCondCred', $xml);
        $this->assertXmlPathValue('Cuota', '/gCamCond/gPagCred/dDCondCred', $xml);
        $this->assertXmlPathValue('2', '/gCamCond/gPagCred/dCuotas', $xml);
        $this->assertXmlPathValue('PYG', '/gCamCond/gPagCred/gCuotas[1]/cMoneCuo', $xml);
        $this->assertXmlPathValue('Guarani', '/gCamCond/gPagCred/gCuotas[1]/dDMoneCuo', $xml);
        $this->assertXmlPathValue('25000', '/gCamCond/gPagCred/gCuotas[1]/dMonCuota', $xml);
        $this->assertXmlPathValue('2026-08-30', '/gCamCond/gPagCred/gCuotas[1]/dVencCuo', $xml);
        $this->assertXmlPathValue('25000', '/gCamCond/gPagCred/gCuotas[2]/dMonCuota', $xml);
    }
}
