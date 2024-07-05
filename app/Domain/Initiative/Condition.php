<?php
namespace App\Domain\Initiative;

use BlueFission\BlueCore\ValueObject;

class Condition extends ValueObject {
	public $condition_id;
	public $initiative_id;
	public $attribute_id;
	public $operator_id;
	public $value;
}