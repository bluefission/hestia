<?php

namespace App\Business\Drivers;

use App\Domain\Communication\Communication;

class HTTPCommunicationDriver extends CommunicationDriver
{
    public function send(Communication $message)
    {
        // Send the message using an HTTP request
        // ...
    }
}
