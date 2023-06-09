<?php
namespace App\Domain\Initiative;

use BlueFission\Framework\ValueObject;

class InitiativeStatus extends ValueObject {
	public $initiative_status_id;
	public $name;
	public $label;
	public $description;
}