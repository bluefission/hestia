<?php
namespace App\Domain\Conversation\Models;

use BlueFission\Framework\Model\ModelSql as Model;

class TopicToTagsPivot extends Model {
	
	protected $_table = 'topic_to_tags';
	protected $_fields = [
		'topic_id',
		'tag_id',
		'weight'
	];
}