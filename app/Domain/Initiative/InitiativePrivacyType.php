<?php
namespace App\Domain\Initiative;

use BlueFission\Framework\ValueObject;

class InitiativePrivacyType extends ValueObject {
	public $initiative_privacy_type_id;
	public $name;
	public $label;
	public $description;
}