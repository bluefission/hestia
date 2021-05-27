<?php
namespace App\Domain;

use BlueFission\Data\Storage\Mysql;

class UserModel extends Mysql {
	protected $_data = [
		'id'=>'',
		'username' => '',
		'password' => '',
	];
}