<?php
namespace App\Domain\Initiative;

use BlueFission\BlueCore\ValueObject;

class Prerequisite extends ValueObject {
	public $prerequisite_id;
	public $initiative_id;
	public $attribute_id;
	public $operator_id;
	public $value;
}