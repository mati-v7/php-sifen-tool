<?php

namespace Nyxcode\PhpSifenTool\Events;

use Symfony\Contracts\EventDispatcher\Event;

/**
 * Event triggered after a SOAP request has been sent.
 *
 * This event can be used to listen for and handle actions that should occur
 * immediately after a SOAP request is dispatched.
 *
 * @package \Nyxcode\PhpSifenTool\Listeners
 */
class SoapRequestSent extends Event
{
    public const NAME = 'soap.request.sent';

    public ?string $endpoint;
    public string $method;
    public string $request;
    public ?string $response;
    public ?string $error;

    public function __construct(
        ?string $endpoint,
        string $method,
        string $request,
        ?string $response = null,
        ?string $error = null
    ) {
        $this->endpoint = $endpoint;
        $this->method = $method;
        $this->request = $request;
        $this->response = $response;
        $this->error = $error;
    }
}
