<?php
namespace Maxlzp\ApiClient\Http;

use GuzzleHttp\Psr7\Message;
use Psr\Log\LoggerInterface;
use Maxlzp\ApiClient\Log\NullLogger;
use GuzzleHttp\Client as GuzzleClient;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

class Client
{
    protected string $baseUri;
    protected GuzzleClient $client;
    protected LoggerInterface $logger;

    /**
     * @param array{
     *      base_uri: "dfghdfghdfgh",
     * } $config
     */
    public function __construct($config, LoggerInterface $logger = null)
    {
        if (! $logger) {
            $this->logger = NullLogger::create();
        }

        $config = array_merge([
            'base_uri' => $this->baseUri,
        ], $config);

        $this->client = new GuzzleClient($config);
    }

    public function send(RequestInterface $request): ResponseInterface
    {
        try {
            $this->onBeforeSend($request);
            $response = $this->client->send($request);
            $this->onAfterSend($response);
            return $response;
        } catch (RequestException $e) {
            $this->logger->error('Request Error:');
            $this->logger->error(Message::toString($e->getRequest()));
            $this->logger->error(Message::toString($e->getResponse()));
            throw $e;
        } catch (\Exception $e) {
            $this->logger->error('Exception is thrown:');
            $this->logger->error($e->getMessage());
            $this->logger->error($e->getTraceAsString());
            throw $e;
        }
    }

    protected function onAfterSend(ResponseInterface $response): void
    {
        $response->getBody()->rewind();
        $this->logger->debug(Message::toString($response));
        $response->getBody()->rewind();
    }

    protected function onBeforeSend(RequestInterface $request): void
    {
        $this->logger->debug(Message::toString($request));
    }

    /**
     * Undocumented function
     *
     * @param array{
     *  airline: 'AA',
     *  flightnumer: '123',
     * } $args
     * @return void
     */
    protected function methodName($args): void
    {
        echo $args;
    }
}
