<?php
namespace App\Domain\User\Models;

use BlueFission\Data\Storage\Mysql;

class UserModel extends Mysql {
	protected $_data = [
		'id'=>'',
		'username' => '',
		'password' => '',
	];
}