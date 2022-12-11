<?
namespace MaxLZp\ApiClient\Http;

use GuzzleHttp\Psr7\Message;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;
use MaxLZp\ApiClient\Log\NullLogger;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Client
{
    protected string $baseUri;
    protected GuzzleClient $client;
    protected LoggerInterface $logger;

    public function __construct(array $config, LoggerInterface $logger = null)
    {
        if (! $logger) {
            $this->logger = NullLogger::create();
        }

        $config = array_merge(array(
            'base_uri' => $this->baseUri,
        ), $config);

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
        $this->logger->debug(Message::toString($response));
    }

    protected function onBeforeSend(RequestInterface $request): void
    {
        $this->logger->debug(Message::toString($request));
    }
}