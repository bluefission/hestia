<?php
namespace App\Domain\User\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;
use BlueFission\Data\Storage\MysqlBulk;

class UserModel extends Model {
	protected $_table = ['users'];
	protected $_fields = ['user_id', 'realname', 'displayname'];

	protected $_ignore_null = true;

	protected function init()
	{
		// $this->_dataObject->relation('id','user_id');
	}
}