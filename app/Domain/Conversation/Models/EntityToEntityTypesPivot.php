<?php
namespace App\Domain\Conversation\Models;

use BlueFission\Framework\Model\ModelSql as Model;

class EntityToEntityTypesPivot extends Model {
	
	protected $_table = 'entity_to_entity_types';
	protected $_fields = [
		'entity_id',
		'entity_type_id',
		'weight',
	];
}