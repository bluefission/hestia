<?php
namespace App\Domain\Content\Queries;

use BlueFission\Connections\Database\MysqlLink;
use App\Domain\Content\Models\ContentModel as Model;

use App\Domain\Content\Queries\IPublishedContentQuery;

class PublishedContentQuerySql implements IPublishedContentQuery {
	private $_model;

	public function __construct( MysqlLink $link, Model $model )
	{
		$link->open();

		$this->_model = $model;
	}

	public function fetch() 
	{
		$model = $this->_model;
		$model->clear();
		$model->is_published = 1;
		$model->read();
		$data = $model->result()->toArray();
		return $data;
	}
}