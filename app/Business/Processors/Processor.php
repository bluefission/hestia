<?php

namespace App\Business\Processors;

abstract class Processor implements IProcessor
{
    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }
}
