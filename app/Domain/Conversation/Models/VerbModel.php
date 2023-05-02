<?php
namespace App\Domain\Conversation\Models;

use BlueFission\Framework\Model\ModelSql as Model;

class VerbModel extends Model {
	
	protected $_table = 'verbs';
	protected $_fields = [
		'verb_id',
		'name',
		'label',
	];
}