<?php
namespace App\Domain\Conversation\Models;

use BlueFission\Framework\Model\ModelSql as Model;

class FactTypeModel extends Model {
	
	protected $_table = 'fact_types';
	protected $_fields = [
		'fact_type_id',
		'name',
		'label',
	];
}