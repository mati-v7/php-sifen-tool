<?php

namespace Nyxcode\PhpSifenTool\Builder\Request\Concrete;

use DOMDocument;
use Nyxcode\PhpSifenTool\Builder\Contracts\RequestBuildable;
use Nyxcode\PhpSifenTool\Builder\Request\AbstractRequestBuilder;
use Nyxcode\PhpSifenTool\Composite\TagComposite;
use Nyxcode\PhpSifenTool\Composite\TagLeaf;
use Nyxcode\PhpSifenTool\Enums\Soap\XML;
use Nyxcode\PhpSifenTool\Enums\Tag\SiConsRUC;

class ConsultaRUCBuilder extends AbstractRequestBuilder implements RequestBuildable
{
    protected TagComposite $rEnviConsRUC;

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
}
