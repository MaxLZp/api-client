<?php
namespace Maxlzp\ApiClient\Test\Http;

use PHPUnit\Framework\TestCase;
use Maxlzp\ApiClient\Test\Mocks\Httpbin\Http\Client;
use GuzzleHttp\Psr7\Request;

class ClientTest extends TestCase
{
    protected Client $client;

    public function setup(): void
    {
        $this->client = new Client();
    }

    /** @test */
    public function shouldPassWithJson(): void
    {
        $url = 'https://www.google.com';
        $bodyArray = [
            'url' => $url,
            'param2' => 'value2',
        ];
        $bodyString = json_encode($bodyArray);
        $request = new Request(
            'POST',
            '/anything',
            [
                'Content-Type' => 'application/json',
            ],
            $bodyString
        );

        $response = $this->client->send($request);
        $response = $response->getBody()->getContents();
        $response = json_decode($response, true);
        $this->assertNotEmpty($response);
        $this->assertTrue(\array_key_exists('url', $response['json']));
        $this->assertEquals($url, $response['json']['url']);
    }

    /** @test */
    public function shouldPassWithXml(): void
    {
        $url = 'https://www.google.com';

        $xmlWriter = new \XMLWriter();
        $xmlWriter->openMemory();

        $xmlWriter->setIndent(1);
        $xmlWriter->setIndentString("\t");
        $xmlWriter->startDocument('1.0', 'UTF-8');

            $xmlWriter->writeElement('url', $url);

        $bodyString = $xmlWriter->outputMemory(true);

        $request = new Request(
            'POST',
            '/anything',
            [
                'Content-Type' => 'application/xml',
            ],
            $bodyString
        );

        $response = $this->client->send($request);
        $response = $response->getBody()->getContents();
        $response = json_decode($response, true);

        $this->assertNotEmpty($response);
        $this->assertTrue(\array_key_exists('data', $response));
        $this->assertEquals($bodyString, $response['data']);
    }

    /** @test  */
    public function shouldPassFormUrlEncoded(): void
    {
        $url = 'https://www.google.com';
        $bodyArray = [
            'url' => $url,
            'param2' => 'value2',
        ];
        $bodyString = http_build_query($bodyArray);
        $request = new Request(
            'POST',
            '/anything',
            [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            $bodyString
        );

        $response = $this->client->send($request);
        $response = $response->getBody()->getContents();
        $response = json_decode($response, true);
        $this->assertNotEmpty($response);
        $this->assertTrue(\array_key_exists('url', $response['form']));
        $this->assertEquals($url, $response['form']['url']);
    }
}