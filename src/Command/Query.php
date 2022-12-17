<?php
namespace Maxlzp\ApiClient\Command;

trait Query
{
    /** @var mixed */
    protected $result;

    /** @return mixed */
    public function getResult()
    {
        return $this->result;
    }
}
