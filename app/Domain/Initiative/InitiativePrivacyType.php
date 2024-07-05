<?php
namespace App\Domain\Initiative;

use BlueFission\BlueCore\ValueObject;

class InitiativePrivacyType extends ValueObject {
	public $initiative_privacy_type_id;
	public $name;
	public $label;
	public $description;
}