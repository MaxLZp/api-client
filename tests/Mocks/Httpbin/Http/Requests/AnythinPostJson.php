<?php
namespace Maxlzp\ApiClient\Test\Mocks\Httpbin\Http\Requests;

use Maxlzp\ApiClient\Http\Method;
use Maxlzp\ApiClient\Http\RequestBuilder;

class AnythinPostJson extends RequestBuilder
{
    protected array $data;
    protected string $method = Method::POST;
    protected string $endpoint = '/anything';
    protected array $headers = [
        'Content-Type' => 'application/json',
    ];

    public function __construct(array $data)
    {
        $this->data = array_filter($data);
    }

    public static function create(array $data): self
    {
        return new static($data);
    }

    public function getBody(): ?string
    {
        return json_encode(array_filter($this->data));
    }
}