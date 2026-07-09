<?php

declare(strict_types=1);

namespace Nyxcode\PhpSifenTool\Domain\Common\ValueObject;

final readonly class BranchName
{
    public function __construct(
        private string $value,
    ) {
        # TODO: Implement branch name validations
    }

    public function value(): string
    {
        return $this->value;
    }
}
