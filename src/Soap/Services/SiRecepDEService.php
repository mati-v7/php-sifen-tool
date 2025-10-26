<?php

namespace Nyxcode\PhpSifenTool\Soap\Services;

use Nyxcode\PhpSifenTool\Builder\DE\Director as DEDirector;
use Nyxcode\PhpSifenTool\Builder\DE\Factory\DEFactory;
use Nyxcode\PhpSifenTool\Builder\Request\Concrete\RecepDEBuilder;
use Nyxcode\PhpSifenTool\Builder\Request\Director;
use Nyxcode\PhpSifenTool\Crypto\DigitalSigner;
use Nyxcode\PhpSifenTool\Enums\DE\TipoDocumentoElectronico;
use Nyxcode\PhpSifenTool\Enums\Tag\DE;
use Nyxcode\PhpSifenTool\Events\SoapRequestSent;
use Nyxcode\PhpSifenTool\Security\SifenCredential;
use Nyxcode\PhpSifenTool\Soap\Classmap\RRetEnviDE;
use Nyxcode\PhpSifenTool\Soap\Contracts\SiRecepDE;
use Nyxcode\PhpSifenTool\Utils\Utilities;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class SiRecepDEService implements SiRecepDE
{
    private \SoapClient $client;
    private ?EventDispatcherInterface $dispatcher;

    public function __construct(
        \SoapClient $client,
        ?EventDispatcherInterface $dispatcher
    ) {
        $this->client = $client;
        $this->dispatcher = $dispatcher;
    }

    public function rEnviDe(int $dId, array $data, SifenCredential $sifenCredential): RRetEnviDE
    {
        // Step 1 - Build DE
        $iTiDE = $data['iTiDE'];
        $DEBuilder = DEFactory::create(TipoDocumentoElectronico::from($iTiDE));
        $DEdirector = new DEDirector();
        $DEdirector->setBuilder($DEBuilder);
        $DEdirector->build($data);
        $DEElement = $DEBuilder->getResult();

        // Step 2 - Build SiRecepDE request
        $builder = new RecepDEBuilder();
        $director = new Director();
        $director->setBuilder($builder);
        $director->buildPayload(
            [
                'dId' => $dId
            ]
        );

        // Step 3 - Attach DE element into SiRecepDE request
        $builder->attachDE($DEElement);
        $doc = $builder->getResult();

        // Step 4 - Sign DE
        $signer = new DigitalSigner($sifenCredential->getCertificate());
        $signer->sign(Utilities::getFirstElementByTagName($doc, DE::DE));

        // Step 5 - Verify DE Signature


        $xml = Utilities::removeXmlProlog($doc->saveXML());
        $params = new \SoapVar($xml, XSD_ANYXML);

        try {
            /** 
             * @var \Nyxcode\PhpSifenTool\Soap\Classmap\RRetEnviDE $response 
             */
            $response = $this->client->__soapCall('rEnviDe', []);
            if ($this->dispatcher) {
                $this->dispatcher->dispatch(
                    new SoapRequestSent(
                        null,
                        'rEnviDe',
                        $this->client->__getLastRequest(),
                        $this->client->__getLastResponse()
                    ),
                    SoapRequestSent::NAME
                );
            }

            return $response;
        } catch (\SoapFault $e) {
            if ($this->dispatcher) {
                $this->dispatcher->dispatch(
                    new SoapRequestSent(
                        null,
                        'rEnviDe',
                        $xml,
                        null,
                        $e->getMessage()
                    ),
                    SoapRequestSent::NAME
                );
            }
            throw $e;
        }
    }
}
