<?php

namespace Nyxcode\PhpSifenTool\Soap\Factory;

use Nyxcode\PhpSifenTool\Soap\Classmap\ResConsRUC;
use Nyxcode\PhpSifenTool\Soap\Classmap\XContRUC;

class ClassMapFactory
{
    public static function get(): array
    {
        return [
            'rResEnviConsRUC' => ResConsRUC::class,
            'tContenedorRuc' => XContRUC::class,
        ];
    }
}
