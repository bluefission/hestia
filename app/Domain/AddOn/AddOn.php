<?php
namespace App\Domain\AddOn;

use BlueFission\Framework\ValueObject;

class AddOn extends ValueObject
{
    public $addon_id;
    public $name;
    public $version;
    public $is_active;
    public $primary_file;
    public $namespace;
    public $path;
    public $description;
}
