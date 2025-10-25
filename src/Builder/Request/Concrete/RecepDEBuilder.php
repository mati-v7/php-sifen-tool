<?php

namespace Nyxcode\PhpSifenTool\Builder\Request\Concrete;

use DOMDocument;
use DOMDocumentFragment;
use DOMElement;
use Nyxcode\PhpSifenTool\Builder\DE\BuilderInterface as DEBuilderInterface;
use Nyxcode\PhpSifenTool\Builder\DE\Concrete\DocumentoElectronicoBuilder;
use Nyxcode\PhpSifenTool\Builder\DE\Director;
use Nyxcode\PhpSifenTool\Builder\DE\Factory\DEFactory;
use Nyxcode\PhpSifenTool\Builder\Request\BuilderInterface;
use Nyxcode\PhpSifenTool\Composite\TagComposite;
use Nyxcode\PhpSifenTool\Composite\TagLeaf;
use Nyxcode\PhpSifenTool\Crypto\Certificate;
use Nyxcode\PhpSifenTool\Crypto\DigitalSigner;
use Nyxcode\PhpSifenTool\Enums\DE\TipoDocumentoElectronico;
use Nyxcode\PhpSifenTool\Enums\Soap\XML;
use Nyxcode\PhpSifenTool\Enums\Tag\DE;
use Nyxcode\PhpSifenTool\Enums\Tag\SiRecepDE;
use Nyxcode\PhpSifenTool\Security\SifenCredential;
use Nyxcode\PhpSifenTool\Utils\Utilities;

class RecepDEBuilder implements BuilderInterface
{
    protected DOMDocument $doc;
    protected TagComposite $rEnviDe;

    public function reset(): void
    {
        $this->doc = new DOMDocument(encoding: "UTF-8");
    }

    public function body(array $data): void
    {
        $this->rEnviDe = new TagComposite(SiRecepDE::R_ENVI_DE, namespace: XML::XML_NS);

        $dId = new TagLeaf(SiRecepDE::D_ID, $data['dId']);
        $this->rEnviDe->add($dId);

        $xDe = new TagComposite(SiRecepDE::X_DE);
        $this->rEnviDe->add($xDe);

        $rDE = new TagComposite(DE::R_DE, namespace: XML::XML_NS, attributes: [
            'xmlns:xsi' => XML::XSI_NS,
            'xsi:schemaLocation' => XML::XSI_SCHEMA_LOCATION
        ]);
        $xDe->add($rDE);

        $element = $this->rEnviDe->render($this->doc);
        $this->doc->appendChild($element);
    }

    public function attachDE(DOMElement $de): void
    {
        $rDE = Utilities::getFirstElementByTagName($this->doc, DE::R_DE);
        $imported = $this->doc->importNode($de, true);
        $rDE->appendChild($imported);
    }

    public function singDE(Certificate $certificate) {}

    public function getResult(): DOMDocument
    {
        return $this->doc;
    }
}
