<?php
namespace App\Domain\Conversation\Models;

use BlueFission\Framework\Model\ModelSql as Model;

class ExperienceModel extends Model {
	
	protected $_table = 'frames';
	protected $_fields = [
		'experience_id',
		'input_id',
		'timestamp',
		'data'
	];
}