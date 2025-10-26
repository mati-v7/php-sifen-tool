<?php

namespace Nyxcode\PhpSifenTool\Builder\Request\Concrete;

use DOMDocument;
use Nyxcode\PhpSifenTool\Builder\Contracts\RequestBuildable;
use Nyxcode\PhpSifenTool\Composite\TagComposite;
use Nyxcode\PhpSifenTool\Composite\TagLeaf;
use Nyxcode\PhpSifenTool\Enums\Soap\XML;
use Nyxcode\PhpSifenTool\Enums\Tag\SiConsRUC;

class ConsultaRUCBuilder implements RequestBuildable
{
    protected DOMDocument $doc;

    protected TagComposite $rEnviConsRUC;

    public function reset(): void
    {
        $this->doc = new DOMDocument(encoding: "UTF-8");
    }

    public function body(array $data): void
    {
        $this->rEnviConsRUC = new TagComposite(SiConsRUC::R_ENVI_CONS_RUC, namespace: XML::XML_NS);

        $dId = new TagLeaf(SiConsRUC::D_ID, $data['dId']);
        $this->rEnviConsRUC->add($dId);

        $dRUCCons = new TagLeaf(SiConsRUC::D_RUC_CONS, $data['dRUCCons']);
        $this->rEnviConsRUC->add($dRUCCons);

        $element = $this->rEnviConsRUC->render($this->doc);
        $this->doc->appendChild($element);
    }

    public function getResult(): DOMDocument
    {
        return $this->doc;
    }
}
