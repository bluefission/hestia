<?php
namespace App\Registration;

class AppRegistration {

	private $_app;
	private $_name = "Application Main";

	public function __construct()
	{
		$this->_app = \App::instance();
	}

	public function name()
	{
		return $this->_name;
	}

	public function init()
	{
		$this->bindings();
		$this->arguments();
	}

	public function registrations()
	{
		$this->_app->delegate('responder', Response::class);
		$this->_app->register('responder', 'post', 'send', Service::SCOPE_LEVEL);
		$this->_app->register('responder', 'get', 'send', Service::SCOPE_LEVEL);
	}

	public function bindings()
	{
		$this->_app->bind('App\Domain\User\Queries\IAllUsersQuery', 'App\Domain\User\Queries\AllUsersQuerySql');
		$this->_app->bind('App\Domain\User\Queries\IAllCredentialStatusesQuery', 'App\Domain\User\Queries\AllCredentialStatusesQuerySql');
		$this->_app->bind('App\Domain\User\Repositories\IUserRepository', 'App\Domain\User\Repositories\UserRepositorySql');
		$this->_app->bind('BlueFission\Data\Storage\Storage', 'BlueFission\Data\Storage\Mysql');
	}

	public function arguments()
	{
		$this->_app->bindArgs( ['config'=>$this->_app->configuration('database')['mysql']], 'BlueFission\Connections\Database\MysqlLink');
	}
}