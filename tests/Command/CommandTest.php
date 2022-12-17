<?php
namespace Maxlzp\ApiClient\Test\Http;

use Maxlzp\ApiClient\Test\Mocks\Httpbin\Command\CustomCommand;
use PHPUnit\Framework\TestCase;


class CommandTest extends TestCase
{
    protected array $data = [
        'url' => 'https://www.google.com',
        'param2' => 'value2',
    ];

    public function setup(): void
    {
        $this->command = new CustomCommand($this->data);
    }

    /** @test */
    public function shouldExecuteCommand(): void
    {
        $result = $this->command->execute()->getResult();
        $this->assertNotEmpty($result);
        $this->assertTrue(\array_key_exists('url', $result['json']));
        $this->assertEquals($this->data['url'], $result['json']['url']);
    }
}