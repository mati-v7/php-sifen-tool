<?php

namespace Nyxcode\PhpSifenTool\Soap\Classmap;

class ResResultLoteDE
{
    public const LOTE_NOT_FOUND = '0360';
    public const LOTE_IN_PROCESS = '0361';
    public const LOTE_PROCESSED = '0362';

    /**
     * Fecha y hora del procesamiento del lote
     * @var string $dFecProc
     */
    public string $dFecProc;

    /**
     * Código de resultado de procesamiento del lote
     * @var string $dCodResLot
     */
    public string $dCodResLot;

    /**
     * Mensaje de resultado de procesamiento del lote
     * @var string $dMsgResLot
     */
    public string $dMsgResLot;

    /**
     * Grupo Resultado de Procesamiento del Lote
     * @var array<Nyxcode\PhpSifenTool\Soap\Classmap\GResProcLote> $gResProcLote
     */
    public array $gResProcLote;

    public function isLoteNotFound(): bool
    {
        return $this->dCodResLot === self::LOTE_NOT_FOUND;
    }

    public function isLoteInProcess(): bool
    {
        return $this->dCodResLot === self::LOTE_IN_PROCESS;
    }

    public function isLoteProcessed(): bool
    {
        return $this->dCodResLot === self::LOTE_PROCESSED;
    }

    public function getDFecProc(): string
    {
        return $this->dFecProc;
    }

    public function getDCodResLot(): string
    {
        return $this->dCodResLot;
    }

    public function getDMsgResLot(): string
    {
        return $this->dMsgResLot;
    }

    public function getGResProcLote(): array
    {
        return $this->gResProcLote;
    }
}
