<?php
namespace App\Domain\Initiative;

use BlueFission\Framework\ValueObject;

class UnitType extends ValueObject {
	public $unit_type_id;
	public $name;
	public $label;
	public $description;
}