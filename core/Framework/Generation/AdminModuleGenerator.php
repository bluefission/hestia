<?php
namespace BlueFission\Framework\Generation;

class AdminModuleGenerator
{
    protected $tableName;

    public function __construct($tableName)
    {
        $this->tableName = $tableName;
    }

    public function generate()
    {
        // Generate an admin module for managing the data in $this->tableName
    }
}
