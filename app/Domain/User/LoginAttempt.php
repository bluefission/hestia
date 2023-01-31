<?php
namespace App\Domain\User;

class LoginAttempt {
	public $login_attempt_id;
	public $ip_address;
	public $username;
	public $attempts;
	public $last_attempt;
}