<?
namespace MaxLZp\ApiClient\Http;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\RequestInterface;

abstract class RequestBuilder
{
    protected string $method = Method::GET;
    protected string $endpoint = '';
    protected array $headers = array();
    protected ?string $body = null;
    protected string $version = '1.1';

    public function build(): RequestInterface
    {
        $request = new Request(
            $this->getMethod(),
            $this->getUri(),
            $this->getHeaders(),
            $this->getBody()
        );

        return $request;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    public function getUri(): Uri
    {
        return new Uri($this->getEndpoint());
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function getVersion(): string
    {
        return $this->version;
    }
}