<?php

namespace Nyxcode\PhpSifenTool\Soap\Factory;

use Nyxcode\PhpSifenTool\Soap\Classmap\GResProc;
use Nyxcode\PhpSifenTool\Soap\Classmap\GResProcLote;
use Nyxcode\PhpSifenTool\Soap\Classmap\ResConsDE;
use Nyxcode\PhpSifenTool\Soap\Classmap\ResConsRUC;
use Nyxcode\PhpSifenTool\Soap\Classmap\ResResultLoteDE;
use Nyxcode\PhpSifenTool\Soap\Classmap\RProtDE;
use Nyxcode\PhpSifenTool\Soap\Classmap\RRetEnviDE;
use Nyxcode\PhpSifenTool\Soap\Classmap\XContRUC;

class ClassMapFactory
{
    /**
     * @return array<string, mixed>
     */
    public static function get(): array
    {
        return [
            'rResEnviConsRUC' => ResConsRUC::class,
            'tContenedorRuc' => XContRUC::class,
            'rEnviConsDeResponse' => ResConsDE::class,
            'rResEnviConsLoteDe' => ResResultLoteDE::class,
            'tgResProcLote' => GResProcLote::class,
            'tgResProc' => GResProc::class,
            'rRetEnviDe' => RRetEnviDE::class,
            'rProtDe' => RProtDE::class,
        ];
    }
}
