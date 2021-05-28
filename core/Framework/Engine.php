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

		$config = require dirname( getcwd() ).DIRECTORY_SEPARATOR.'common'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'application.php';

		foreach ( $config['aliases'] as $alias=>$classname ) {
			class_alias($classname, $alias);
		}

		foreach ( $config['extensions'] as $extension ) {

			$class = new $extension();
			$class->init();
			$this->addExtension( $class->name() );
		}

		foreach ( $config['gateways'] as $name=>$gateway ) {
			$this->_gateways[$name] => $gateway;
		}
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