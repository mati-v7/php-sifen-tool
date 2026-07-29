<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\DE\Entity;

use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ResponsibleDocument;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ResponsibleName;
use Nyxcode\PhpSifenTool\Domain\Common\ValueObject\ResponsiblePosition;

final class DEResponsible
{
    public function __construct(
        private readonly ResponsibleDocument $document,
        private readonly ResponsibleName $name,
        private readonly ResponsiblePosition $position,
    ) {}

    public function document(): ResponsibleDocument
    {
        return $this->document;
    }

    public function name(): ResponsibleName
    {
        return $this->name;
    }

    public function position(): ResponsiblePosition
    {
        return $this->position;
    }
}
