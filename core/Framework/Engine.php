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

		$this->autoDiscoverRouting();
		$this->autoDiscoverConfig();

		return $this;
	}

	public function handleRoutes() {
		// $this->delegate('web', 'BlueFission\Framework\Web')
		// 	->register('web', 'test', 'handleGet');
	}

	private function autoDiscoverRouting() {
		$this->_loader->load("routing.*");
	}

	private function autoDiscoverConfig() {
		// $this->_loader->load("common.config.*");
	}
}