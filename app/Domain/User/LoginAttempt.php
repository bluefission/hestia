<?php
namespace App\Domain\User;
use BlueFission\Framework\ValueObject;

class LoginAttempt extends ValueObject{
	public $login_attempt_id;
	public $ip_address;
	public $username;
	public $attempts;
	public $last_attempt;
}