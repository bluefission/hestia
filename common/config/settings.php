<?php

// Some error handling to be removed later
ini_set('display_errors', 1);
ini_set("error_log", dirname(getcwd())."/storage/log/error.log");
error_reporting(E_ALL);
set_time_limit(3000);

// TODO: set this in a config file
date_default_timezone_set('America/New_York');

if (!defined("OPUS_ROOT") ){
	define('OPUS_ROOT', dirname(dirname(dirname(__FILE__))).'/');	
}
if (!defined("SITE_ROOT") ){
	define('SITE_ROOT', OPUS_ROOT.'/public');	
}
if (!defined("DEBUG") ){
	define('DEBUG', false);
}

if(!function_exists('import_env_vars')) {
	function import_env_vars( $file ) {
		$variables = file($file);
		foreach ($variables as $var) {
			putenv(trim($var));
		}
	}
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

if(file_exists( OPUS_ROOT.'/.env' )) {
  import_env_vars( OPUS_ROOT.'/.env' );
}