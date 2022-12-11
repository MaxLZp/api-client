<?
namespace  MaxLZp\ApiClient\Log;

use Psr\Log\LogLevel;
use Psr\Log\LoggerInterface;

abstract class Logger implements LoggerInterface
{

    /**
     * @param string $level
     * @param string $message
     * @param array $context
     * @return void
     */
    abstract public function log($level, $message, $context = array());

    /**
     * @param string $message
     * @param array $context
     * @return void
     */
    public function emergency($message, $context = array())
    {
        $this->log(LogLevel::EMERGENCY, $message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     * @return void
     */
    public function alert($message, $context = array())
    {
        $this->log(LogLevel::ALERT, $message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     * @return void
     */
    public function critical($message, $context = array())
    {
        $this->log(LogLevel::CRITICAL, $message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     * @return void
     */
    public function error($message, $context = array())
    {
        $this->log(LogLevel::ERROR, $message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     * @return void
     */
    public function warning($message, $context = array())
    {
        $this->log(LogLevel::WARNING, $message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     * @return void
     */
    public function notice($message, $context = array())
    {
        $this->log(LogLevel::NOTICE, $message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     * @return void
     */
    public function info($message, $context = array())
    {
        $this->log(LogLevel::INFO, $message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     * @return void
     */
    public function debug($message, $context = array())
    {
        $this->log(LogLevel::DEBUG, $message, $context);
    }
}