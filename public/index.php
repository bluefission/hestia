<?php
use BlueFission\Utils\Loader;
use BlueFission\Utils\Util;
use BlueFission\Net\HTTP;
use BlueFission\Framework\Engine as App;

// Some error handling to be removed later
ini_set('display_errors', 1);
ini_set("error_log", dirname(getcwd())."/storage/log/error.log");
error_reporting(E_ALL);
set_time_limit(3000);

// TODO: set this in a config file
date_default_timezone_set('America/New_York');

if(file_exists( dirname(dirname(__FILE__)).'/env.php')) {
  include_once( dirname(dirname(__FILE__)).'/env.php' );
}

if(!function_exists('env')) {
  function env($key, $default = null)
  {
      $value = getenv($key);

      if ($value === false) {
          return $default;
      }
      return $value;
  }
}

$autoloader = require '../vendor/autoload.php';

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