<?php
namespace App\Domain\Initiative;

use BlueFission\Framework\ValueObject;

///////
// User Attributes
///

class Attribute extends ValueObject {
	public $attribute_id;
	public $name;
	public $label;
	public $description;
}