<?php

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
		'\App'			=>'\BlueFission\Framework\Engine'
	],

	// Extensions to the application functionality
	'extensions'		=> [
		'App\Registration\AppRegistration',
	],

	// Gateways for processing requests
	'gateways'=> [
		'auth'			=>'\BlueFission\Framework\Gateway\AuthenticationGateway',
		'admin:auth'	=>'\App\Business\Gateways\AdminAuthenticationGateway',
	],
];