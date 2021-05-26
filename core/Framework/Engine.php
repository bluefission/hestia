<?php
namespace BlueFission\Framework;

use BlueFission\Services\Application;
use BlueFission\Services\Service;
use BlueFission\Services\Response;
use BlueFission\Utils\Loader;

class Engine extends Application {

	private $_loader;

	public function __construct()
	{
		parent::__construct();
		$this->init();
	}

	private function autoDiscoverRouting() {
		$this->_loader->load("routing");
	}

	private function autoDiscoverConfig() {
		$this->_loader->load("common.config");
	}

	protected function init() {
		parent::init();
		$this->_loader = Loader::instance();
	}
}