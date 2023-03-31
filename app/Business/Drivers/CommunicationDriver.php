<?php
namespace App\Business\Drivers;

use App\Domain\Communication\Communication;

abstract class CommunicationDriver
{
    abstract public function send(Communication $message);
}
