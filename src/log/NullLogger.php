<?php
namespace  MaxLZp\ApiClient\Log;

class NullLogger extends Logger
{
    /**
     * @param string $level
     * @param string $message
     * @param array $context
     * @return void
     */
    public function log($level, $message, $context = array())
    {
        // Does nothing
    }

    public static function create(): self
    {
        return new static();
    }
}
