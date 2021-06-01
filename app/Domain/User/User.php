<?php
namespace App\Domain\User;

use BlueFission\DevObject;

class User extends DevObject {
	protected $_data = [
		'user_id'=>'',
		'realname' => '',
		'displayname' => '',
	];
}