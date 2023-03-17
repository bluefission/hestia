<?php
namespace App\Registration;

use App\Business\Managers\SkillManager;
use App\Business\MysqlConnector;

use BlueFission\Services\Service;

// For Conversations
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Cache\SymfonyCache;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

/**
 * Class AppRegistration
 *
 * This class contains logic for registering different components and dependencies in the application
 *
 * @package App\Registration
 */
class AppRegistration {
	/**
	 * The instance of the app
	 *
	 * @var object
	 */
	private $_app;
	
	/**
	 * The name of the app
	 *
	 * @var string
	 */
	private $_name = "Application Main";
	
	/**
	 * AppRegistration constructor.
	 */
	public function __construct() {
		$this->_app = \App::instance();
	}

	/**
	 * Get the name of the app
	 *
	 * @return string
	 */
	public function name() {
		return $this->_name;
	}

	/**
	 * Initialize the registrations
	 */
	public function init() {
		$this->bindings();
		$this->arguments();
		$this->registrations();
	}

	/**
	 * Register different components in the app
	 */
	public function registrations() {
		$this->_app->delegate('skills', SkillManager::class);
		$this->_app->delegate('mysql', MysqlConnector::class);

		DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);
		$adapter = new FilesystemAdapter();
		$botman = BotManFactory::create([], new SymfonyCache($adapter));
		$this->_app->delegate('bot', $botman);
	}

	/**
	 * Bind different components with their respective implementations
	 */
	public function bindings() {
		$this->_app->bind('App\Domain\User\Queries\IAllUsersQuery', 'App\Domain\User\Queries\AllUsersQuerySql');
		$this->_app->bind('App\Domain\User\Queries\IAllCredentialStatusesQuery', 'App\Domain\User\Queries\AllCredentialStatusesQuerySql');
		$this->_app->bind('App\Domain\User\Repositories\IUserRepository', 'App\Domain\User\Repositories\UserRepositorySql');
		$this->_app->bind('BlueFission\Data\Storage\Storage', 'BlueFission\Data\Storage\Mysql');

		$this->_app->bind('BlueFission\Framework\Skill\IAnalyzer', 'BlueFission\Framework\Skill\Analyzer');
	}

	/**
	 * Pass arguments to different components
	 */
	public function arguments() {
		$this->_app->bindArgs( ['config'=>$this->_app->configuration('database')['mysql']], 'BlueFission\Connections\Database\MysqlLink');
		$this->_app->bindArgs( ['config'=>$this->_app->configuration('machinelearning')['sagemaker']], 'BlueFission\Framework\Datasource\SageMaker');
	}
}
