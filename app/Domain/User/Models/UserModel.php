<?php
namespace App\Domain\User\Models;

use BlueFission\Framework\Model\ModelSql as Model;
use BlueFission\Data\Storage\MysqlBulk;

class UserModel extends Model {
	protected $_table = ['users','credentials'];
	protected $_fields = ['user_id', 'credential_id', 'username', 'realname', 'displayname'];

	protected $_ignore_null = true;

	protected function init()
	{
		// $this->_dataObject->relation('id','user_id');
	}
}