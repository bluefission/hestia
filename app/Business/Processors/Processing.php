<?php

namespace App\Business\Processors;

use App\Domain\Configuration\ConfigLoader;
use InvalidArgumentException;

class Processing
{
    protected $config;
    protected $processors;

    public function __construct(int $configId)
    {
        $this->config = ConfigLoader::load($configId);
        $this->processors = $this->config->processors;
    }

    public function process($input)
    {
        $processorName = $this->config->processor_name;

        if (!isset($this->processors[$processorName])) {
            throw new InvalidArgumentException("Processor '{$processorName}' not found.");
        }

        $processorClass = $this->processors[$processorName];
        $processor = new $processorClass($this->config);

        return $processor->execute($input);
    }
}
