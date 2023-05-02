<?php

namespace App\Business\Drivers;

use App\Domain\Communication\Communication;

class HTTPCommunicationDriver extends CommunicationDriver
{
    public function send(Communication $communiation)
    {
        // Send the communication using an HTTP request
        // ...
    }
}
