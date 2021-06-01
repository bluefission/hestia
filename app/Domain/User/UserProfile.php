<?php
namespace App\Domain\User;

use BlueFission\DevObject;

class UserProfile extends DevObject {
	protected $_data = [
		'user_profile_id'=>'',
		'username' => '',
	];
}