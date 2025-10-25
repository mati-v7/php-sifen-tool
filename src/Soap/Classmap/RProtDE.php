<?php

namespace Nyxcode\PhpSifenTool\Soap\Classmap;

class RProtDE
{
    /**
     * CDC del DE Procesado
     * @var string $id
     */
    protected string $id;

    /**
     * Fecha y hora del procesamiento
     * @var string $dFecProc
     */
    protected string $dFecProc;

    /**
     * DigestValue del DE procesado
     * @var string $dDigVal
     */
    protected string $dDigVal;

    /**
     * Estado del resultado
     * @var string $dEstRes
     */
    protected string $dEstRes;

    /**
     * Número de Transacción
     * @var string $dProtAut
     */
    protected string $dProtAut;

    /**
     * Grupo Resultado de Procesamiento
     * @var GResProc $gResProc
     */
    protected GResProc $gResProc;

    public function getId(): string
    {
        return $this->id;
    }

    public function getDFecProc(): string
    {
        return $this->dFecProc;
    }

    public function getDDigVal(): string
    {
        return $this->dDigVal;
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
