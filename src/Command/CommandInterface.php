<?php
namespace Maxlzp\ApiClient\Command;

interface CommandInterface
{
    /** @return self */
    public function execute(): self;
}
