<?php

namespace Nyxcode\PhpSifenTool\Soap\Classmap;

class RRetEnviDE
{
    /**
     * Protocolo de procesamiento del DE
     * @var RProtDE $rProtDe
     */
    protected RProtDE $rProtDe;

    public function getRProtDe(): RProtDE
    {
        return $this->rProtDe;
    }
}
