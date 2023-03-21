<?php
namespace App\Business\Drivers;

use App\Domain\User\Models\CommunicationModel;

abstract class CommunicationDriver
{
    abstract public function send(CommunicationModel $message);
}
