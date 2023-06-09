<?php
namespace App\Domain\Initiative;

use BlueFission\Framework\ValueObject;

class InitiativeToUser extends ValueObject {
	public $initiative_id;
	public $user_id;
}