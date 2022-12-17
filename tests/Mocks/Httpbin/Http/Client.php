<?php
namespace Maxlzp\ApiClient\Test\Mocks\Httpbin\Http;

use Maxlzp\ApiClient\Http\Client as HttpClient;

class Client extends HttpClient
{
    protected string $baseUri = 'https://httpbin.org';

    public function __construct()
    {
        parent::__construct([
            'headers' => [
                'Content-Type' => 'application/json',
            ]
        ]);
    }



}