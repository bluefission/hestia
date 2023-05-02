<?php
namespace App\Domain\Conversation\Models;

use BlueFission\Framework\Model\ModelSql as Model;

class EntityToTagsPivot extends Model {
	
	protected $_table = 'entity_to_tags';
	protected $_fields = [
		'entity_id',
		'tag_id',
		'weight'
	];
}