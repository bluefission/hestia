<?php
use BlueFission\Utils\Loader;
use BlueFission\Utils\Util;
use BlueFission\Net\HTTP;
use BlueFission\Framework\Engine as App;

require '../vendor/autoload.php';

$autoloader = require '../common/config/settings.php';

// Loder utility for non-composer compatible scripts
$loader = Loader::instance();
$loader->addPath(dirname(getcwd()));
$loader->addPath(dirname(getcwd()).DIRECTORY_SEPARATOR."app");

session_start();
if (empty(HTTP::session('_token'))) {
    HTTP::session('_token', Util::csrf_token());
}

$app = App::instance();
$app
	->bootstrap()
	->args()
	->validateCsrf()
	->run();