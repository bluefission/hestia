<?php

namespace App\Business\Drivers;

use App\Domain\Communication\Communication;
use BotMan\BotMan\BotMan;

class BotManCommunicationDriver extends CommunicationDriver
{
    protected $botman;

    public function __construct()
    {
        $this->botman = \App::instance()->service('botman');
    }

    public function send(Communication $message)
    {
        // Send the message using the BotMan instance
        $user = $message->user_id; // Assuming the Communication has a reference to the User object
        sleep(1);
        $this->botman->typesAndWaits(2);

        $this->botman->say($message->content, $user);
    }
}
