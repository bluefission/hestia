<?php
namespace App\Domain\User\Models;

use BlueFission\Framework\Model\ModelSql as Model;
use BlueFission\Data\Storage\MysqlBulk;

class CredentialModel extends Model {
	protected $_table = ['credentials'];
	protected $_fields = ['credential_id', 'credential_status_id', 'user_id', 'is_primary' 'username', 'password'];
}