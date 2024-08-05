<?php
namespace App\Business\Drivers;

use BlueFission\BlueCore\Domain\Communication\Communication;

abstract class CommunicationDriver
{
    abstract public function send(Communication $message);
}
