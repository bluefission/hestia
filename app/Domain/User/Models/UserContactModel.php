<?php
namespace App\Domain\User\Models;

use BlueFission\Framework\Model\ModelSql as Model;
use BlueFission\Data\Storage\MysqlBulk;

class UserContactModel extends Model {
	protected $_table = ['user_contacts'];
	protected $_fields = ['user_contact_id', 'user_id', ''];
}