<?php
namespace BlueFission\Framework;

use BlueFission\Services\Application;
use BlueFission\Services\Service;
use BlueFission\Services\Response;
use BlueFission\Behavioral\Behaviors\Event;
use BlueFission\Utils\Loader;

class Engine extends Application {

	private $_loader;

	private $_extensions = [];
	private $_configurations = [];

	public function bootstrap() {

		// $this->handleRoutes();

		$this->_loader = Loader::instance();

		$this->boost(new Event('OnAppInitialized'));

		$this->loadConfiguration();

		$this->autoDiscoverHelpers();

		$this->autoDiscoverMapping();


		$this->boost(new Event('OnAppLoaded'));
		
		return $this;
	}

	public function loadConfiguration() {

		// Data

		$database = require dirname( dirname( dirname( __FILE__ ) ) ).DIRECTORY_SEPARATOR.'common'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'database.php';

		$this->_configurations['database'] = $database;

		// Application Logic

		$config = require dirname( dirname( dirname( __FILE__ ) ) ).DIRECTORY_SEPARATOR.'common'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'application.php';

		$this->_configurations['app'] = $config;

		foreach ( $config['aliases'] as $alias=>$classname ) {
			class_alias($classname, $alias);
		}

		foreach ( $config['extensions'] as $extension ) {

			$class = new $extension();
			$class->init();
			$this->addExtension( $class->name() );
		}

		foreach ( $config['gateways'] as $name=>$gateway ) {
			$this->gateway($name, $gateway);
		}
	}

	public function configuration(string $key = '')
	{
		if ( $key ) {
			return $this->_configurations[$key];
		}
		return $this->_configurations;
	}

	private function autoDiscoverMapping() {
		$this->_loader->load("mapping.*");
	}

	private function autoDiscoverHelpers() {
		$this->_loader->load("common.helpers.*");
	}

	private function addExtension( $extension ) {
		$this->_extensions[] = $extension;
	}
}