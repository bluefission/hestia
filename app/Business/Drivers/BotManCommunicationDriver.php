<?php

namespace App\Business\Drivers;

use App\Domain\Communication\Communication;
use BotMan\BotMan\BotMan;

class BotManCommunicationDriver extends CommunicationDriver
{
    protected $botman;

    public function __construct()
    {
        $this->botman = instance('botman');
    }

    public function send(Communication $communication)
    {
        // Send the communication using the BotMan instance
        $user = $communication->user_id; // Assuming the Communication has a reference to the User object
        $this->botman->typesAndWaits(2);

        $this->botman->say(nl2br($communication->content), $user);
    }
}
