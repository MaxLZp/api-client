<?php
namespace Maxlzp\ApiClient\Test\Http;

use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;
use Maxlzp\ApiClient\Http\Response;
use Maxlzp\ApiClient\Test\Mocks\Httpbin\Http\Client;

class ResponseJsonTest extends TestCase
{
    protected Client $client;
    protected Request $request;
    protected array $data = [
        'url' => 'https://www.google.com',
        'param2' => 'value2',
    ];

    public function setup(): void
    {
        $this->client = new Client();
        $this->request = new Request(
            'POST',
            '/anything',
            [
                'Content-Type' => 'application/json',
            ],
            json_encode($this->data)
        );
    }

    /** @test */
    public function shouldPassWithJson(): void
    {
        $response = $this->client->send($this->request);
        $response = Response::json($response);
        $this->assertNotEmpty($response);
        $this->assertTrue(\array_key_exists('url', $response['json']));
        $this->assertEquals($this->data['url'], $response['json']['url']);
    }

}