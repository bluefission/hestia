<?php
namespace App\Domain\Initiative\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class ObjectiveModel extends Model {
	protected $_table = 'objectives';
	protected $_fields = [
		'objective_id',
		'initiative_id',
		'kpi_type_id',
		'operator_id',
		'unit_type_id',
		'value',
	];
}