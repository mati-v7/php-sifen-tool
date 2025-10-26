<?php

namespace Nyxcode\PhpSifenTool\Listeners;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Nyxcode\PhpSifenTool\Events\SoapRequestSent;

/**
 * Class SoapRequestLogger
 *
 * Responsible for logging SOAP requests and responses for debugging and auditing purposes.
 *
 * This class can be used to capture and store the details of SOAP communications,
 * including request and response payloads, headers, and any relevant metadata.
 *
 * @package \Nyxcode\PhpSifenTool\Listeners
 */
class SoapRequestLogger
{
    private Logger $logger;

    public function __construct()
    {
        $formatter = new LineFormatter(null, null, true, true);
        $handler = new StreamHandler(__DIR__ . '/../../storage/logs/soap.log', Level::Info);
        $handler->setFormatter($formatter);

        $this->logger = new Logger('soap');
        $this->logger->pushHandler($handler);
    }

    public function __invoke(SoapRequestSent $event): void
    {
        $this->logger->info('SOAP Request Sent', [
            'endpoint' => $event->endpoint,
            'method'   => $event->method,
            'request'  => $event->request,
            'response' => $event->response,
            'error'    => $event->error,
        ]);
    }
}
