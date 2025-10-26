<?php

namespace Nyxcode\PhpSifenTool\Builder\Request\Concrete;

use DOMDocument;
use Nyxcode\PhpSifenTool\Builder\Contracts\RequestBuildable;
use Nyxcode\PhpSifenTool\Composite\TagComposite;
use Nyxcode\PhpSifenTool\Composite\TagLeaf;
use Nyxcode\PhpSifenTool\Enums\Soap\XML;
use Nyxcode\PhpSifenTool\Enums\Tag\SiResultLoteDE;

class ResultLoteDEBuilder implements RequestBuildable
{
    protected DOMDocument $doc;
    protected TagComposite $rEnviConsLoteDe;

    public function reset(): void
    {
        $this->doc = new DOMDocument(encoding: "UTF-8");
    }

    public function body(array $data): void
    {
        $this->rEnviConsLoteDe = new TagComposite(SiResultLoteDE::R_ENVI_CONS_LOTE_DE, namespace: XML::XML_NS);

        $dId = new TagLeaf(SiResultLoteDE::D_ID, $data['dId']);
        $this->rEnviConsLoteDe->add($dId);

        $dProtConsLote = new TagLeaf(SiResultLoteDE::D_PROT_CONS_LOTE, $data['dProtConsLote']);
        $this->rEnviConsLoteDe->add($dProtConsLote);

        $element = $this->rEnviConsLoteDe->render($this->doc);
        $this->doc->appendChild($element);
    }

    public function getResult(): DOMDocument
    {
        return $this->doc;
    }
}
