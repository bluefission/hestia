<?php
namespace App\Domain\User;
use BlueFission\BlueCore\ValueObject;

class UserProfile extends ValueObject
{
	public $user_profile_id;
	public $username;
}