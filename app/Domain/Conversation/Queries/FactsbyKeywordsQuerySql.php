<?php
namespace App\Domain\Conversation\Queries;

use BlueFission\Connections\Database\MysqlLink;
use App\Domain\Conversation\Models\FactModel as Model;

use App\Domain\Conversation\Queries\IFactsByKeywordsQuery;

class FactsByKeywordsQuerySql implements IFactsByKeywordsQuery {
	private $_model;

	public function __construct( MysqlLink $link, Model $model )
	{
		$link->open();

		$this->_model = $model;
	}

	public function fetch($input) 
	{
		$model = $this->_model;
		$model->clear();
        $model->condition('var', 'LikE', explode(" ", trim($input)) );
        $model->condition('value', 'LikE', explode(" ", trim($input)) );
        $model->read();

		$data = $model->result()->toArray();
		return $data;
	}
}