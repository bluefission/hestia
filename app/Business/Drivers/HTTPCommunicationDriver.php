<?php

namespace App\Business\Drivers;

use BlueFission\BlueCore\Domain\Communication\Communication;
use BlueFission\Net\{HTTPClient, Request};
use BlueFission\Connections\Curl;

class HTTPCommunicationDriver extends CommunicationDriver
{
    public function send(Communication $communiation)
    {
        $client = new HTTPClient( new Curl() ); // PSR-18 HTTP Client
        $request = new Request();
        $request->setBody( $communication->content );
        $response = $client->sendRequest( $request );
    }
}
