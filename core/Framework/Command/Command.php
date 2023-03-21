<?php
namespace BlueFission\Framework\Command;

// Command.php
class Command
{
    public $verb;
    public $resources;
    public $args;

    public function __construct()
    {
        $this->resources = [];
        $this->args = [];
    }
}