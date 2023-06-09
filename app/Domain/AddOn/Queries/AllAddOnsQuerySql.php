<?php
namespace App\Domain\AddOn\Queries;

use BlueFission\Connections\Database\MysqlLink;
use App\Domain\AddOn\Models\AddOnModel as Model;

use App\Domain\AddOn\Queries\IAllAddOnsQuery;

class AllAddOnsQuerySql implements IAllAddOnsQuery {
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