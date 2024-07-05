<?php
namespace App\Domain\User\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;
use BlueFission\Data\Storage\MysqlBulk;

class UserProfileModel extends Model {
	protected $_table = ['user_profiles'];
	protected $_fields = ['user_profile_id', 'user_id', ''];
}