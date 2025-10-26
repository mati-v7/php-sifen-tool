<?php

namespace Nyxcode\PhpSifenTool\Builder\Request\Concrete;

use DOMDocument;
use Nyxcode\PhpSifenTool\Builder\Contracts\RequestBuildable;
use Nyxcode\PhpSifenTool\Builder\Request\AbstractRequestBuilder;
use Nyxcode\PhpSifenTool\Composite\TagComposite;
use Nyxcode\PhpSifenTool\Composite\TagLeaf;
use Nyxcode\PhpSifenTool\Enums\Soap\XML;
use Nyxcode\PhpSifenTool\Enums\Tag\SiConsDE;

class ConsDEBuilder extends AbstractRequestBuilder implements RequestBuildable
{
    protected TagComposite $rEnviConsDE;

    public function body(array $data): void
    {
        $this->rEnviConsDE = new TagComposite(SiConsDE::R_ENVI_CONS_DE_REQUEST, namespace: XML::XML_NS);

        $dId = new TagLeaf(SiConsDE::D_ID, $data['dId']);
        $this->rEnviConsDE->add($dId);

        $dCDC = new TagLeaf(SiConsDE::D_CDC, $data['dCDC']);
        $this->rEnviConsDE->add($dCDC);

        $element = $this->rEnviConsDE->render($this->doc);
        $this->doc->appendChild($element);
    }
}
