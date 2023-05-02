<?php
namespace App\Domain\Conversation\Models;

use BlueFission\Framework\Model\ModelSql as Model;

class DialogueTypeModel extends Model {
	
	protected $_table = 'dialogue_types';
	protected $_fields = [
		'dialogue_type_id',
		'name',
		'label'
	];
}