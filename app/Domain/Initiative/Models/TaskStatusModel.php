<?php
namespace App\Domain\Initiative\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class TaskStatusModel extends Model {
	protected $_table = 'task_statuses';
	protected $_fields = [
		'task_status_id',
		'name',
		'label',
		'description',
	];
}