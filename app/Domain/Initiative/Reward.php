<?php
namespace App\Domain\Initiative;

use BlueFission\Framework\ValueObject;

class Reward extends ValueObject {
	public $reward_id;
	public $initiative_id;
	public $attribute_id;
	public $operator_id;
	public $unit_type_id;
	public $value;
}