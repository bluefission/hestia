<?php
namespace App\Domain\User;

use BlueFission\DevObject;

class User extends DevObject {
	protected $_data = [
		'id'=>'',
		'username' => '',
		'password' => '',
	];
}