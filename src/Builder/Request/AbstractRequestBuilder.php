<?php

namespace Nyxcode\PhpSifenTool\Builder\Request;

use DOMDocument;
use Nyxcode\PhpSifenTool\Builder\Contracts\RequestBuildable;

class AbstractRequestBuilder implements RequestBuildable
{
    protected DOMDocument $doc;

    /**
     * Resets the builder to its initial state.
     * Override in concrete builders if necessary.
     * @return void
     */
    public function reset(): void
    {
        $this->doc = new DOMDocument(encoding: "UTF-8");
    }

    /**
     * Builds the body of the request using the provided data.
     * To be implemented in concrete builders.
     * @param array<mixed> $data
     * @return void
     */
    public function body(array $data): void
    {
        // To be implemented in concrete builders
    }

    /**
     * Gets the resulting DOMDocument after building the request.
     * Override in concrete builders if necessary.
     * @return DOMDocument
     */
    public function getResult(): DOMDocument
    {
        return $this->doc;
    }

    public function getDoc(): DOMDocument
    {
        return $this->doc;
    }
}
