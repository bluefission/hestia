<?php

namespace App\Business\Processors;

use App\Domain\Logic\LogicHandler;
use App\Models\LogicModel;

class DynamicProcessor extends Processor
{
    public function execute($input)
    {
        $output = null;
        $handler = new LogicHandler();
        $logicModel = new LogicModel();
        $logicId = $this->config->logic_id;
        $logic = $logicModel->read(['logic_id' => $logicId])->all();

        foreach ($logic as $rules) {
            $handler->config($rules->toArray());
            $output = $handler->input($input);
        }

        return $output;
    }
}
