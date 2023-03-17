<?php
namespace BlueFission\Framework\Skill\Intent;

class Context
{
    public $name;
    public $userID;

    public function __construct(string $name, string $userID)
    {
        $this->name = $name;
        $this->userID = $userID;
    }
}