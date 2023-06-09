<?php
namespace App\Domain\Initiative\Models;

use BlueFission\Framework\Model\ModelSql as Model;

class UnitTypeModel extends Model {
	const AMOUNT = 'Amount Unit Type';
	const PERCENT = 'Percent Unit Type';
	const DISTANCE = 'Distance Unit Type';
	const TIME = 'Time Unit Time';
	
	protected $_table = 'unit_types';
	protected $_fields = [
		'unit_type_id',
		'name',
		'label',
		'description',
	];
}