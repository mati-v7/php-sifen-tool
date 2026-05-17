<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Service;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\CDC;
use Nyxcode\PhpSifenTool\Domain\DE\Entity\ElectronicDocument;

final class CDCGenerator
{
    public function generate(
        ElectronicDocument $document,
    ): CDC {
        $timbrado = $document->taxAuthorization();
        $operation = $document->operation();

        $value =
            $timbrado->documentType()->value
            .$document->issuer()->ruc()->value()
            .$timbrado->establishment()->value()
            .$timbrado->expeditionPoint()->value()
            .$timbrado->documentNumber()->value()
            .$document->issuedAt()->format('Ymd')
            .$operation->emissionType()->value
            .$operation->securityCode()->value();

        return new CDC($value);
    }
}
