<?php

namespace Nyxcode\PhpSifenTool\Soap\Classmap;

class GResProcLote
{
    /**
     * CDC del DE procesado
     * @var string $id
     */
    public string $id;

    /**
     * Estado del resultado
     * @var string $dEstRes
     */
    public string $dEstRes;

    /**
     * Número de transacción
     * @var string $dProtAut
     */
    public string $dProtAut;

    /**
     * Grupo de Mensaje de Resultado
     * @var GResProc $gResProc
     */
    public GResProc $gResProc;

    public function getId(): string
    {
        return $this->id;
    }

    public function getDEstRes(): string
    {
        return $this->dEstRes;
    }

    public function getDProtAut(): string
    {
        return $this->dProtAut;
    }

    public function getGResProc(): GResProc
    {
        return $this->gResProc;
    }
}
