<?php
namespace App\Domain\Conversation\Queries;

use BlueFission\Connections\Database\MysqlLink;
use App\Domain\Conversation\Models\TopicRouteModel as Model;

use App\Domain\Conversation\Queries\ITopicRoutesByTopicQuery;

class TopicRoutesByTopicQuerySql implements ITopicRoutesByTopicQuery {
	private $_model;

	public function __construct( MysqlLink $link, Model $model )
	{
		$link->open();

		$this->_model = $model;
	}

	public function fetch($topic_id) 
	{
		$model = $this->_model;
		$model->from = $topic_id;
		$model->read();
		$data = $model->result()->toArray();
		return $data;
	}
}