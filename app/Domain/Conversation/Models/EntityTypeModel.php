<?php
namespace App\Domain\Conversation\Models;

use BlueFission\Framework\Model\ModelSql as Model;

class EntityTypeModel extends Model {
	
	protected $_table = 'entity_types';
	protected $_fields = [
		'entity_type_id',
		'name',
		'label',
	];
}