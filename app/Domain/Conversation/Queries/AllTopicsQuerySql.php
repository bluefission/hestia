<?php
namespace App\Domain\Conversation\Queries;

use BlueFission\Connections\Database\MysqlLink;
use App\Domain\Conversation\Models\TopicModel as Model;

use App\Domain\Conversation\Queries\IAllTopicQuery;

class AllTopicsQuerySql implements IAllTopicsQuery {
	private $_model;

	public function __construct( MysqlLink $link, Model $model )
	{
		$link->open();

		$this->_model = $model;
	}

	public function fetch() 
	{
		$model = $this->_model;
		$model->read();
		$data = $model->result()->toArray();
		return $data;
	}
}