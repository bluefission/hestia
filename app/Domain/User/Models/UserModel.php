<?php
namespace App\Domain\User\Models;

use BlueFission\Framework\Model\ModelSql as Model;
use BlueFission\Data\Storage\MysqlBulk;

class UserModel extends Model {
	protected $_table = ['users','credentials'];
	protected $_fields = ['id', 'username', 'realname', 'displayname'];

	protected function init()
	{
		$this->_dataObject->relation('id','user_id');
	}
}