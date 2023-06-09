<?php
namespace App\Domain\AddOn\Queries;

use BlueFission\Connections\Database\MysqlLink;
use App\Domain\AddOn\Models\AddOnModel as Model;

use App\Domain\AddOn\Queries\IActivatedAddOnsQuery;

class ActivatedAddOnsQuerySql implements IActivatedAddOnsQuery {
	private $_model;

	public function __construct( MysqlLink $link, Model $model )
	{
		$link->open();

		$this->_model = $model;
	}

	public function fetch() 
	{
		$model = $this->_model;
        $model->assign(['is_active' => 1]);
		$model->read();
		$data = $model->result()->toArray();
		return $data;
	}
}