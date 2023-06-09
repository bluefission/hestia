<?php
namespace App\Domain\Initiative\Queries;

use BlueFission\Connections\Database\MysqlLink;
use App\Domain\Initiative\Models\ObjectiveModel as Model;

use App\Domain\Initiative\Queries\IInitiativeObjectivesQuery;

class InitiativeObjectivesQuerySql implements IInitiativeObjectivesQuery {
	private $_model;

	public function __construct( MysqlLink $link, Model $model )
	{
		$link->open();

		$this->_model = $model;
	}

	public function fetch($initiative_id) 
	{
		$model = $this->_model;
		$model->initiative_id = $initiative_id;
		$model->read();
		$data = $model->result()->toArray();
		return $data;
	}
}