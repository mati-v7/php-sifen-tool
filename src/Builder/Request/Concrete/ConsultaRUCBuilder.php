<?php

namespace Nyxcode\PhpSifenTool\Builder\Request\Concrete;

use DOMDocument;
use Nyxcode\PhpSifenTool\Builder\Request\BuilderInterface;
use Nyxcode\PhpSifenTool\Composite\TagComposite;
use Nyxcode\PhpSifenTool\Composite\TagLeaf;
use Nyxcode\PhpSifenTool\Enums\Tag\SiConsRUC;

class ConsultaRUCBuilder implements BuilderInterface
{
    protected DOMDocument $doc;

    protected TagComposite $rEnviConsRUC;

    public function reset()
    {
        $this->doc = new DOMDocument(encoding: "UTF-8");
        $this->doc->formatOutput = true;
    }

    public function body($data)
    {
        $this->rEnviConsRUC = new TagComposite(SiConsRUC::R_ENVI_CONS_RUC);

        $dId = new TagLeaf(SiConsRUC::D_ID, $data['dId']);
        $this->rEnviConsRUC->add($dId);

        $dRUCCons = new TagLeaf(SiConsRUC::D_RUC_CONS, $data['dRUCCons']);
        $this->rEnviConsRUC->add($dRUCCons);
    }

    public function getResult()
    {
        $element = $this->rEnviConsRUC->render($this->doc);
        $this->doc->appendChild($element);
        return $this->doc->saveXML();
    }
}
