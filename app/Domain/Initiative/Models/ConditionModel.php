<?php
namespace App\Domain\Initiative\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class ConditionModel extends Model {
	protected $_table = 'conditions';
	protected $_fields = [
		'condition_id',
		'initiative_id',
		'attribute_id',
		'operator_id',
		'value',
	];
}