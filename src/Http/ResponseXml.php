<?php
namespace MaxLZp\ApiClient\Http;

use Psr\Http\Message\ResponseInterface;

class ResponseXml extends Response
{
    protected function buildResponseArray(ResponseInterface $response): array
    {
        $xml = simplexml_load_string($response->getBody()->getContents());
        $json = json_encode($xml);
        return json_decode($json, true);
    }
}
