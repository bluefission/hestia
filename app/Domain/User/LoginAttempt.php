<?php
namespace App\Domain\User;

use BlueFission\DevObject;

class LoginAttempt extends DevObject {
	protected $_data = [
		'login_attempt_id'=>'',
		'ip_address' => '',
		'attempts'=>'',
		'last_attempt'=>'',
	];
}