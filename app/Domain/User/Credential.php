<?php
namespace App\Domain\User;

use BlueFission\DevObject;

class Credential extends DevObject {
	protected $_data = [
		'credential_id'=>'',
		'username' => '',
		'password' => '',
		'credential_status_id'=>'',
		'is_primary'=>'',
	];
}