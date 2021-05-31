<?php
namespace App\Domain\User\Queries;

use App\Domain\User\Models\UserModel as Model;
// use BlueFission\Data\Storage\MysqlBulk;
use BlueFission\Connections\Database\MysqlLink;

use App\Domain\User\Queries\IAllUserQuery;

class AllUsersQuerySql implements IAllUsersQuery {
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
		$status = $model->status();
		$query = $model->query();

		return response($data);
	}
}