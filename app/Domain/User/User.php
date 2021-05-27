<?php
namespace App\Domain;

use BlueFission\DevObject;

class User extends DevObject {
	protected $_data = [
		'id'=>'',
		'username' => '',
		'password' => '',
	];
}