<?php
namespace App\Domain\Initiative;

use BlueFission\BlueCore\ValueObject;

class Operator extends ValueObject {
	public $operator_id;
	public $name;
	public $label;
	public $description;
}