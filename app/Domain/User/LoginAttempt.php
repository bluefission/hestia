<?php
namespace App\Domain\User;

class LoginAttempt {
	public $login_attempt_id;
	public $ip_address;
	public $attempts;
	public $last_attempt;
}