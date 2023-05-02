<?php
namespace App\Domain\Communication\Queries;

use BlueFission\Connections\Database\MysqlLink;
use App\Domain\Communication\Models\CommunicationsModel as Model;

use App\Domain\Communication\Queries\IAllCommunicationsQuery;

class AllCommunicationsQuerySql implements IAllCommunicationssQuery {
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