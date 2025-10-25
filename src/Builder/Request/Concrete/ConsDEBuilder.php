<?php

namespace Nyxcode\PhpSifenTool\Builder\Request\Concrete;

use DOMDocument;
use Nyxcode\PhpSifenTool\Builder\Request\BuilderInterface;
use Nyxcode\PhpSifenTool\Composite\TagComposite;
use Nyxcode\PhpSifenTool\Composite\TagLeaf;
use Nyxcode\PhpSifenTool\Enums\Soap\XML;
use Nyxcode\PhpSifenTool\Enums\Tag\SiConsDE;

class ConsDEBuilder implements BuilderInterface
{
    protected DOMDocument $doc;
    protected TagComposite $rEnviConsDE;

    public function reset(): void
    {
        $this->doc = new DOMDocument(encoding: "UTF-8");
    }

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

    public function getResult(): DOMDocument
    {
        return $this->doc;
    }
}
