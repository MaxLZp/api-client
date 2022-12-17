<?php
namespace Maxlzp\ApiClient\Http;

use Psr\Http\Message\ResponseInterface;

abstract class Response implements \ArrayAccess
{
    abstract protected function buildResponseArray(ResponseInterface $response): array;

    protected array $response = array();
    protected string $statusCode;

    public function __construct(ResponseInterface $response)
    {
        $this->statusCode = $response->getStatusCode();
        $this->response = $this->buildResponseArray($response);
        $response->getBody()->rewind();
    }

    public static function json(ResponseInterface $response): self
    {
        return new ResponseJson($response);
    }

    public static function xml(ResponseInterface $response): self
    {
        return new ResponseXml($response);
    }

    public function asArray(): array
    {
        return array_filter($this->response);
    }

    public function getStatusCode(): string
    {
        return $this->statusCode;
    }

    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->response[] = $value;
        } else {
            $this->response[$offset] = $value;
        }
    }

    public function offsetExists($offset): bool
    {
        return isset($this->response[$offset]);
    }

    public function offsetUnset($offset): void
    {
        unset($this->response[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->response[$offset]) ? $this->response[$offset] : null;
    }
}
