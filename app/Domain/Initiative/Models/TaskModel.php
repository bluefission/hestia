<?php
namespace App\Domain\Initiative\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class TaskModel extends Model {
	protected $_table = 'tasks';
	protected $_fields = [
		'task_id',
		'initiative_id',
		'kpi_type_id',
		'task_status_id',
		'description',
		'quantity',
		'duration',
		'min',
		'max',
	];

	public function kpis() 
	{
		
	}
}