<?php
namespace App\Domain\Conversation\Queries;

use BlueFission\Connections\Database\MysqlLink;
use App\Domain\Conversation\Models\TagModel as Model;

use App\Domain\Conversation\Queries\ITagsByTopicQuery;

class TagsByTopicQuerySql implements ITagsByTopicQuery {
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