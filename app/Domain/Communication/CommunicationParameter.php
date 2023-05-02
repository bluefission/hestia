<?php
namespace App\Domain\Communication;

use BlueFission\Framework\ValueObject;

class CommunicationParameter extends ValueObject
{
    public $communication_parameter_id;
    public $communication_id;
    public $name;
    public $value;
}

