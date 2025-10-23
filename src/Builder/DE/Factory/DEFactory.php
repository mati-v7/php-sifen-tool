<?php

namespace Nyxcode\PhpSifenTool\Builder\DE\Factory;

use Nyxcode\PhpSifenTool\Builder\DE\BuilderInterface;
use Nyxcode\PhpSifenTool\Builder\DE\Concrete\FacturaElectronicaBuilder;
use Nyxcode\PhpSifenTool\Enums\DE\TipoDocumentoElectronico;

class DEFactory
{
    public static function create(TipoDocumentoElectronico $tipoDocumentoElectronico): BuilderInterface
    {
        return match ($tipoDocumentoElectronico) {
            TipoDocumentoElectronico::FE => new FacturaElectronicaBuilder(),
            // Other cases can be added here for different document types
            default => throw new \InvalidArgumentException('Unsupported TipoDocumentoElectronico type.'),
        };
    }
}
