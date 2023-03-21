<?php

namespace App\Business\Drivers;

use App\Domain\Communication\Models\CommunicationModel;
use BotMan\BotMan\BotMan;

class BotManCommunicationDriver extends BaseDriver
{
    protected $botman;

    public function __construct()
    {
        $this->botman = \App::instance()->service('botman');
    }

    public function send(CommunicationModel $message)
    {
        // Send the message using the BotMan instance
        $user = $message->user; // Assuming the CommunicationModel has a reference to the User object
        $this->botman->say($message->content, $user->getId());
    }
}
