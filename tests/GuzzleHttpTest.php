<?php

namespace Maxlzp\ApiClient\Test;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

/**
 * @link http://httpbin.org/
 * @link https://www.postman.com/devrel/workspace/openai/documentation/13183464-90abb798-cb85-43cb-ba3a-ae7941e968da
 */
class GuzzleHttpTest extends TestCase
{
    protected $client;

    public function setUp(): void
    {
        $this->client = new Client([
            'base_uri' => 'https://httpbin.org',
            'Content-Type' => 'application/xml'
        ]);
    }

    /** @test */
    public function shouldPassJson(): void
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

    /** @test  */
    public function shouldPassFormMultipart(): void
    {

        $url = 'https://www.google.com';
        $bodyArray = [
            [
                'name' => 'name2',
                'contents' => $url,
            ],
            [
                'name' => 'param2',
                'contents' => 'value2',
            ],
        ];
        // $bodyString = '--__X_PAW_BOUNDARY__
        // Content-Disposition: form-data; name="name2"

        // '.$url.'
        // --__X_PAW_BOUNDARY__
        // Content-Disposition: form-data; name="param2"

        // value2
        // --__X_PAW_BOUNDARY__--
        // ';
        $bodyString = json_encode($bodyArray);
        $request = new Request(
            'POST',
            '/anything',
            [
                'Content-Type' => 'multipart/form-data',
            ],
            $bodyString
        );

        $response = $this->client->send($request);
        $response = $response->getBody()->getContents();
        var_dump($response);
        $response = json_decode($response, true);
    }
}
