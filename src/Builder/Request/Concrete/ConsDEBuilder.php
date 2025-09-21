<?php

namespace Nyxcode\PhpSifenTool\Builder\Request\Concrete;

use DOMDocument;
use Nyxcode\PhpSifenTool\Builder\Request\BuilderInterface;
use Nyxcode\PhpSifenTool\Composite\TagComposite;
use Nyxcode\PhpSifenTool\Composite\TagLeaf;
use Nyxcode\PhpSifenTool\Enums\Tag\SiConsDE;
use SifenTool\Utils\Utilities;

class ConsDEBuilder implements BuilderInterface
{
    protected DOMDocument $doc;
    protected TagComposite $rEnviConsDE;

    public function reset()
    {
        $this->doc = new DOMDocument(encoding: "UTF-8");
    }

    public function body($data)
    {

        $this->rEnviConsDE = new TagComposite(SiConsDE::R_ENVI_CONS_DE_REQUEST, attributes: [
            'xmlns' => 'http://ekuatia.set.gov.py/sifen/xsd'
        ]);

        $dId = new TagLeaf(SiConsDE::D_ID, $data['dId']);
        $this->rEnviConsDE->add($dId);

        $dCDC = new TagLeaf(SiConsDE::D_CDC, $data['dCDC']);
        $this->rEnviConsDE->add($dCDC);
    }

    public function getResult()
    {
        $element = $this->rEnviConsDE->render($this->doc);
        $this->doc->appendChild($element);

        $savedXML = Utilities::removeXmlProlog($this->doc->saveXML());
        return $savedXML;
    }
}
