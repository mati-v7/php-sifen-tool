<?php

namespace Nyxcode\PhpSifenTool\Builder\Request\Concrete;

use DOMDocument;
use Nyxcode\PhpSifenTool\Builder\Request\BuilderInterface;
use Nyxcode\PhpSifenTool\Composite\TagComposite;
use Nyxcode\PhpSifenTool\Composite\TagLeaf;
use Nyxcode\PhpSifenTool\Enums\Tag\SiResultLoteDE;
use Nyxcode\PhpSifenTool\Utils\Utilities;

class ResultLoteDEBuilder implements BuilderInterface
{
    protected DOMDocument $doc;
    protected TagComposite $rEnviConsLoteDe;

    public function reset(): void
    {
        $this->doc = new DOMDocument(encoding: "UTF-8");
    }

    public function body(array $data): void
    {
        $this->rEnviConsLoteDe = new TagComposite(SiResultLoteDE::R_ENVI_CONS_LOTE_DE, attributes: [
            'xmlns' => 'http://ekuatia.set.gov.py/sifen/xsd'
        ]);

        $dId = new TagLeaf(SiResultLoteDE::D_ID, $data['dId']);
        $this->rEnviConsLoteDe->add($dId);

        $dProtConsLote = new TagLeaf(SiResultLoteDE::D_PROT_CONS_LOTE, $data['dProtConsLote']);
        $this->rEnviConsLoteDe->add($dProtConsLote);
    }

    public function getResult(): string
    {
        $element = $this->rEnviConsLoteDe->render($this->doc);
        $this->doc->appendChild($element);

        $savedXML = Utilities::removeXmlProlog($this->doc->saveXML());
        return $savedXML;
    }
}
