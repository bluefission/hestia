<?php
namespace App\Domain\Initiative;

use BlueFission\Framework\ValueObject;

class Operator extends ValueObject {
	public $operator_id;
	public $name;
	public $label;
	public $description;
}