<?php
namespace Maxlzp\ApiClient\Test\Mocks\Httpbin\Command;

use Maxlzp\ApiClient\Command\CommandInterface;
use Maxlzp\ApiClient\Command\Query;
use Maxlzp\ApiClient\Command\QueryInterface;
use Maxlzp\ApiClient\Test\Mocks\Httpbin\Http\Client;
use GuzzleHttp\Psr7\Request;
use Maxlzp\ApiClient\Http\Response;
use Maxlzp\ApiClient\Test\Mocks\Httpbin\Http\Requests\AnythinPostJson;

class CustomCommand implements CommandInterface, QueryInterface
{
    use Query;

    protected Client $client;
    protected Request $request;


    public function __construct($data)
    {
        $this->client = new Client();
        $this->request = AnythinPostJson::create($data)->build();
    }

    /** @return self */
    public function execute(): self
    {
        $response = $this->client->send($this->request);
        $this->result = Response::json($response);
        return $this;
    }
}