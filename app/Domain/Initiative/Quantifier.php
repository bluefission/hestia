<?php
namespace App\Domain\Initiative;

use BlueFission\BlueCore\ValueObject;

class Quantifier extends ValueObject {
	public $quantifier_id;
	public $name;
	public $label;
	public $description;
}