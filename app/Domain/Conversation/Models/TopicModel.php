<?php
namespace App\Domain\Conversation\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class TopicModel extends Model {
	
	protected $_table = 'topics';
	protected $_fields = [
		'topic_id',
		'name',
		'label',
		'weight'
	];

	public function routes()
	{
		return $this->associates('App\Domain\Conversation\Models\TopicModel', 'App\Domain\Conversation\Models\TopicRouteModel', 'topic_id', 'to', 'from' );
	}

	public function tags()
	{	
		return $this->associates('App\Domain\Conversation\Models\TagModel', 'App\Domain\Conversation\Models\TopicToTagsPivot', 'tag_id');
	}
}