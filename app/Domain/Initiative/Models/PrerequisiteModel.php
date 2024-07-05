<?php
namespace App\Domain\Initiative\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class PrerequisiteModel extends Model {
	protected $_table = 'prerequisites';
	protected $_fields = [
		'prerequisite_id',
		'initiative_id',
		'attribute_id',
		'operator_id',
		'value',
	];
}