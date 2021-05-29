<?php

if(file_exists(dirname(dirname(dirname(__FILE__))).'/env.php')) {
  include_once( dirname(dirname(dirname(__FILE__))).'/env.php' );
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

if (!defined("SITE_ROOT") ){
	define('SITE_ROOT', dirname(dirname(dirname(__FILE__))).'/');	
}
if (!defined("DASH_ROOT") ){
	define('DASH_ROOT', dirname(dirname(dirname(__FILE__))).'/');	
}
if (!defined("DEBUG") ){
	define('DEBUG', false);
}

return [

	// Class alias for scope and extensibility 
	'aliases'=>[
		'\App'				=>'\BlueFission\Framework\Engine'
	],

	// Extensions to the application functionality
	'extensions'		=> [
		'App\Registration\AppRegistration',
	],

	// Gateways for processing requests
	'gateways'=> [
		'auth'				=>'\BlueFission\Framework\Gateways\AuthenticationGateway',
		'admin:auth'	=>'\App\Business\Gateways\AdminAuthenticationGateway',
	],
];