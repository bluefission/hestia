<?php
namespace App\Domain\Conversation\Models;

use BlueFission\Framework\Model\ModelSql as Model;

class TopicRouteModel extends Model {
	
	protected $_table = 'topic_routes';
	protected $_fields = [
		'topic_route_id',
		'from',
		'to',
		'weight',
	];
}