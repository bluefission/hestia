<?php
namespace App\Domain\User;

use BlueFission\Data\Storage\Mysql;

class User extends Mysql {
	protected $_data = [
		'id'=>'',
		'username' => '',
		'password' => '',
	];
}