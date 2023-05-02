<?php
namespace App\Domain\Conversation\Models;

use BlueFission\Framework\Model\ModelSql as Model;

class LanguageModel extends Model {
	
	protected $_table = 'languages';
	protected $_fields = [
		'language_id',
		'name',
		'label',
	];
}