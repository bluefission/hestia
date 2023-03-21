<?php
namespace App\Domain\User\Models;

use BlueFission\Framework\Model\ModelSql as Model;
use BlueFission\Data\Storage\MysqlBulk;

class CredentialStatusModel extends Model {
	protected $_table = ['credential_statuses'];
	protected $_fields = ['credential_status_id', 'name', 'label'];
}