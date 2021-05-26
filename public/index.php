<?php
use BlueFission\Utils\Loader;
use BlueFission\Framework\Engine as App;

// Some error handling to be removed later
ini_set('display_errors', 1);
error_reporting(E_ALL);
set_time_limit(3000);

// TODO: set this in a config file
date_default_timezone_set('America/New_York');

$autoloader = require '../vendor/autoload.php';

// Loder utility for non-composer compatible scripts
$loader = Loader::instance();
$loader->addPath(dirname(getcwd()));
$loader->addPath(dirname(getcwd()).DIRECTORY_SEPARATOR."app");

$loader->load('core.Framework.*');

$app = App::instance();

$app
	->bootstrap()
	->args()
	->run();