<?php

namespace App\Business\Drivers;

use App\Domain\User\Models\CommunicationModel;

class HTTPCommunicationDriver extends BaseDriver
{
    public function send(CommunicationModel $message)
    {
        // Send the message using an HTTP request
        // ...
    }
}
