<?php

namespace App\Business\Processors;

use App\Domain\API\APICall;
use App\Domain\Function\FunctionExec;
use App\Domain\Condition\RunCondition;

class LogicHandler
{
    protected $config;

    public function config(array $config)
    {
        $this->config = (object)$config;
    }

    public function input($input)
    {
        if ($this->isParentConditionMet($input)) {
            if ($this->config->function) {
                $exec = new FunctionExec($this->config->function);
                return $exec->execute($input);
            } elseif ($this->config->api) {
                $api = new APICall($this->config->api);
                return $api->call($input);
            }
        }

        return $input;
    }

    private function isParentConditionMet($input)
    {
        if ($this->config->parent_id) {
            $condition = new RunCondition($this->config->parent_id);
            $isConditionMet = $condition->evaluate($input);

            if ($isConditionMet) {
                return $this->runParentLogic($input);
            }

            return false;
        }

        return true;
    }

    private function runParentLogic($input)
