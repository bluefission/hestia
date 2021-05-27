<?php
namespace BlueFission\Framework;

use BlueFission\Services\Application;
use BlueFission\Services\Service;
use BlueFission\Services\Response;
use BlueFission\Utils\Loader;

class Engine extends Application {

	private $_loader;

	public function bootstrap() {

		// $this->handleRoutes();

		$this->_loader = Loader::instance();

		$this->autoDiscoverMapping();
		$this->autoDiscoverHelpers();
		$this->autoDiscoverConfig();

		$this->loadRegistrations();

		return $this;
	}

	public function loadRegistrations() {
		// $this->delegate('web', 'BlueFission\Framework\Web')
		// 	->register('web', 'test', 'handleGet');
	}

	private function autoDiscoverMapping() {
		$this->_loader->load("mapping.*");
	}

	private function autoDiscoverHelpers() {
		$this->_loader->load("common.helpers.*");
	}

	private function autoDiscoverConfig() {
		// $this->_loader->load("common.config.*");
	}
}