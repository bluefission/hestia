<?php
namespace App\Domain\Initiative;

use BlueFission\BlueCore\ValueObject;

class InitiativeToUser extends ValueObject {
	public $initiative_id;
	public $user_id;
}