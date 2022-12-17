<?php
namespace Maxlzp\ApiClient\Http;

use Psr\Http\Message\ResponseInterface;

class ResponseJson extends Response
{
    protected function buildResponseArray(ResponseInterface $response): array
    {
        return json_decode($response->getBody()->getContents(), true);
    }
}