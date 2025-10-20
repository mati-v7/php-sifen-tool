<?php

namespace Nyxcode\PhpSifenTool\Tests\Unit;

use Nyxcode\PhpSifenTool\Utils\Utilities;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class UtilitiesTest extends TestCase
{
    #[Test]
    public function test_it_calculates_known_ruc_check_digit()
    {
        $this->assertEquals(2, Utilities::mod11('80063527'));
    }

    #[Test]
    public function test_it_returns_zero_for_resto_one_or_less()
    {
        $this->assertEquals(0, Utilities::mod11('0'));
    }

    #[Test]
    public function test_it_is_deterministic_for_same_input()
    {
        $out1 = Utilities::mod11('80063527');
        $out2 = Utilities::mod11('80063527');
        $this->assertEquals($out1, $out2);
    }
}
