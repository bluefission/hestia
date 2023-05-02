<?php
namespace App\Domain\Communication;
use BlueFission\Framework\ValueObject;

class Communication extends ValueObject
{
    public $communication_id;
    public $user_id;
    public $recipient_id;
    public $communication_type_id;
    public $content;
    public $channel;
    public $communication_status_id;
}

