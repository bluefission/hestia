<?php
namespace App\Domain\Conversation\Models;

use BlueFission\Framework\Model\ModelSql as Model;

class ConversationModel extends Model {
	
	protected $_table = 'conversations';
	protected $_fields = [
		'conversation_id',
	];
}