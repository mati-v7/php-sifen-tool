<?php

namespace Nyxcode\PhpSifenTool\Tests\Feature;

use Nyxcode\PhpSifenTool\Builder\Request\Concrete\ConsultaRUCBuilder;
use Nyxcode\PhpSifenTool\Builder\Request\Director;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ConsRUCTest extends TestCase
{

    public static function dataProvider(): array
    {
        return [
            ["data" => [
                'dId' => rand(100000, 999999),
                'dRUCCons' => '800197268'
            ]]
        ];
    }

    #[DataProvider('dataProvider')]
    public function test_build_cons_ruc_message($data)
    {
        $builder = new ConsultaRUCBuilder();
        $director = new Director();

        $director->setBuilder($builder);
        $director->buildConsRUC($data);

        $product = $builder->getResult();
        $this->assertStringContainsString('<rEnviConsRUC>', $product);
        $this->assertStringContainsString('<dId>' . $data['dId'] . '</dId>', $product);
        $this->assertStringContainsString('<dRUCCons>' . $data['dRUCCons'] . '</dRUCCons>', $product);
        $this->assertStringContainsString('</rEnviConsRUC>', $product);

        // print $product;
    }
}
