<?php
namespace App\Domain\Initiative;

use BlueFission\BlueCore\ValueObject;

class InitiativeType extends ValueObject {
	public $initiative_type_id;
	public $name;
	public $label;
	public $description;
}