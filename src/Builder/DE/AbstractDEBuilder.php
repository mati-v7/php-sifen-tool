<?php

namespace Nyxcode\PhpSifenTool\Builder\DE;

use DOMDocument;
use DOMElement;
use Nyxcode\PhpSifenTool\Builder\Contracts\DEBuildable;
use Nyxcode\PhpSifenTool\Composite\TagComposite;
use Nyxcode\PhpSifenTool\Utils\Utilities;

abstract class AbstractDEBuilder implements DEBuildable
{
    protected DOMDocument $doc;

    /** @var \Nyxcode\PhpSifenTool\Composite\TagComposite $de */
    protected TagComposite $de;

    /** @var string $cdc */
    protected string $cdc;

    /** @var string $dCodSeg */
    protected string $dCodSeg;

    /** @var string $dDVId */
    protected string $dDVId;

    public function generateCDC(array $data): string
    {
        $cdc = Utilities::leftZero($data['iTiDE'], 2) .
            Utilities::leftZero($data["dRucEm"], 8) .
            $data["dDVEmi"] .
            Utilities::leftZero($data["dEst"], 3) .
            Utilities::leftZero($data["dPunExp"], 3) .
            Utilities::leftZero($data["dNumDoc"], 7) .
            $data["iTipCont"] .
            date('Ymd', strtotime($data['dFeEmiDE'])) .
            $data["iTipEmi"] .
            $this->dCodSeg;

        $dvId = Utilities::mod11($cdc);
        $cdc .= $dvId;
        $this->dDVId = $dvId;
        $this->cdc = $cdc;

        return $this->cdc;
    }

    /**
     * Resets the builder to its initial state.
     * Override in concrete builders if necessary.
     * @return void
     */
    public function reset(): void
    {
        $this->doc = new DOMDocument(encoding: "UTF-8");
        $this->dCodSeg = Utilities::generateSecurityCode();
    }

    /**
     * Gets the resulting DOMElement after building the document.
     * Override in concrete builders if necessary 
     * @return \DOMElement DE Element
     */
    public function getResult(): DOMElement
    {
        $this->doc->appendChild($this->de->render($this->doc));
        return $this->doc->documentElement;
    }

    public function getDoc(): DOMDocument
    {
        return $this->doc;
    }

    public function getCdc(): string
    {
        return $this->cdc;
    }

    public function getDCodSeg(): string
    {
        return $this->dCodSeg;
    }

    public function getDDVId(): string
    {
        return $this->dDVId;
    }
}
