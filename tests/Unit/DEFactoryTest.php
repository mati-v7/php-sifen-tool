<?php

namespace Nyxcode\PhpSifenTool\Tests\Unit;

use Nyxcode\PhpSifenTool\Builder\DE\Concrete\FacturaElectronicaBuilder;
use Nyxcode\PhpSifenTool\Builder\DE\Factory\DEFactory;
use Nyxcode\PhpSifenTool\Enums\DE\TipoDocumentoElectronico;
use PHPUnit\Framework\TestCase;

class DEFactoryTest extends TestCase
{

    public function test_it_factory_creates_factura_electronica_builder()
    {
        $builder = DEFactory::create(
            TipoDocumentoElectronico::FE
        );

        $this->assertInstanceOf(
            FacturaElectronicaBuilder::class,
            $builder
        );
    }

    public function test_it_expects_exception_for_unsupported_tipo_documento_electronico()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Unsupported TipoDocumentoElectronico type.');

        DEFactory::create(
            TipoDocumentoElectronico::from(8)
        );
    }
}
